<?php
namespace App\Libraries;
use App\Libraries\JsonrpcClient;

class Demon
{
	private $user;
	private $psw;
	private $ip;
	private $demonport;
	private $privatekey;
	protected $bitcoin;
    protected $address;
	protected $from;
	protected $to;
	protected $balance;
	protected $amout;
	
	public function __construct()
	{
		$this->username = env('RPC_USERNAME','');
		$this->psw = env('RPC_PASSWORD','');
		$this->ip = env('RPC_IP','');
		$this->demonport = env('RPC_PORT','');
		$this->bitcoin = new JsonrpcClient($this->username, $this->psw, $this->ip, $this->demonport);
	}
	
	public function getInfo()
	{
		return $this->bitcoin->getinfo();
	}
	
	public function getnewaddress($label=null)
	{
		echo "in";
		if(!is_null($label))
		{
			$this->address = $this->bitcoin->getnewaddress($label);
		} 
		else
		{
	    	$this->address = $this->bitcoin->getnewaddress();
		}
		dd($this->address);
	    if(!empty($this->address)){
	        $validate = self::validateaddress($this->address);
	        if($validate){
	        $data['address'] = $this->address;
	        $data['publickey'] = $validate['pubkey'];
				$this->privatekey = self::dumpprivkey($this->address);
				if($this->privatekey){
	               $data['privatekey'] = $this->privatekey;
				} 
	           return $data;
	        }
	        return false;
	    }
	    return false;
	}
	
	private function dumpprivkey($address)
	{
	    $this->address = $address;
	    $validate = self::validateaddress($this->address);
	    if($validate)
	    {
	        $this->privatekey = $this->bitcoin->dumpprivkey($this->address);
	        return $this->privatekey;
	    } else {
	        return false;
	    }
	}
	
	public function validateaddress($address)
	{
	    $this->address = $address;
	    $validate = $this->bitcoin->validateaddress($this->address);
	    if($validate['isvalid'] === true)
	    {
	        return $validate;
	    }
	    else
	    {
	         return false;
	    }
	}
	
	public function send($form, $to, $amout, $pvkey=null, $fee=null)
	{
	    $this->from = $form;
		$this->amout = $amout;
		$this->to = $to;
		$this->privatekey = array($this->dumpprivkey($form));
		$utxos =  self::listunspent($this->from);
		if(!empty($utxos)){
			$this->balance = self::txbalance($utxos);
			$utxo = self::utxo($utxos);
			if($fee!= null){
				$total_send = bcadd($this->amout, $fee, 8);
			} else {
				$total_send = bcadd($this->amout, 0.0001, 8);
			}
			if($this->balance >= $total_send) {
				$newbalance = (float)bcsub($this->balance, $total_send, 8);
				$tx = array(
					$this->to => $this->amout,
					$this->from => $newbalance
				);
				$rawtx = self::createrawtransaction($utxo,$tx);
				if($rawtx){
					$hex = self::signrawtransaction($rawtx, $utxos, $this->privatekey);
					if($hex){
					    $this->bitcoin->decoderawtransaction($hex);
 					   	$tx = self::sendrawtransaction($hex);
					   	if($tx){
					   	    return $tx;
					   	} else {
					   	    return "send Transaction failed"; 
					   	}
					} else {
						return "Raw Transaction failed"; 
					}
				} else {
					return "create Transaction failed"; 
				}
			} else {
				return "Insufficient funds"; 
			}
		} else {
			return "Insufficient funds";
		}
	}
	
	
	public function sendmany($form, $to, $pvkey, $fee=null)
	{
	    $this->from = $form;
		$this->amout = 0;
		$this->to = $to;
		$this->privatekey[] = $pvkey;
		$utxos =  self::listunspent($this->from);
		
		if(!empty($utxos)){
			$this->balance = self::txbalance($utxos);
			$utxo = self::utxo($utxos);
			$values = array_values($to);
			
			foreach($values as $value){
				$this->amout = bcadd($this->amout, $value, 8); 
			} 
			if($fee!= null){
				$total_send = bcadd($this->amout, $fee, 8);
			} else {
				$total_send = bcadd($this->amout, 0.00001, 8);
			}
			if($this->balance >= $total_send) {
				$newbalance = (float)bcsub($this->balance, $total_send, 8);
				$change = array($this->from => $newbalance);
				$txaddress = array_merge($this->to, $change);
				$rawtx = self::createrawtransaction($utxo,$txaddress);
				if($rawtx){
					$hex = self::signrawtransaction($rawtx, $utxos, $this->privatekey);
					if($hex){
					    $tx = self::sendrawtransaction($hex);
					    if($tx){
					   	    return $tx;
					   	} else {
					   	    return false; 
					   	}
					} else {
						return false; 
					}
				} else {
					return false; 
				}
			} else {
				return false; 
			}
		} else {
			return false;
		}
	}

	public function sendtoaddress($flashcoinaddress,$amount)
	{
		if(!empty($flashcoinaddress) && !empty($amount)){		
		    $rawtx = $this->bitcoin->sendtoaddress($flashcoinaddress, $amount,"Admin wallet");			
		   	if(!empty($rawtx)){
				return $rawtx;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function createrawtransaction($utxo,$tx)
	{
		if(!empty($utxo) && !empty($tx)){
		    $rawtx = $this->bitcoin->createrawtransaction($utxo, $tx);
		   	if(!empty($rawtx)){
				return $rawtx;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	private function signrawtransaction($rawtx, $utxos, $pvkey)
	{
		if(!empty($rawtx) && !empty($utxos) && !empty($pvkey)){
			$this->privatekey = $pvkey;
			$hex = $this->bitcoin->signrawtransaction($rawtx, $utxos, $this->privatekey);
			if($hex['hex']){
				return $hex['hex'];
			} else {
				return false;
			}
		}
	}
	
	private function sendrawtransaction($hex)
	{
		if(!empty($hex)){
			$txid = $this->bitcoin->sendrawtransaction($hex);
			if(!empty($txid)){
		    	return $txid;
			} else {
			    return false;
			}
		} else {
			return false;
		}
		
	}
	
	public function listunspent($address=null)
	{
		$data = array();
		$this->balance = 0;
		$this->address = $address;
		if(!is_null($this->address))
			$utxos = $this->bitcoin->listunspent(1, 9999999, [$this->address]);
		else 
			$utxos = $this->bitcoin->listunspent(1, 9999999);
		if(!empty($utxos)){
			return $utxos;
		}
        return $data;
	}
	
	private function utxo($utxos)
	{
		$datas = array();
		if(!empty($utxos)){
    	     foreach($utxos as $utxo){
            	$data[] = array(
            		'txid' => $utxo['txid'],
            		'vout' => $utxo['vout'],
                );
            }
            return $data;
	    }
		return $datas;
	}
	
	private function txbalance($utxos)
	{
		$this->balance = 0;
		if(!empty($utxos)){
    	     foreach($utxos as $utxo){
            	$this->balance = bcadd($this->balance, $utxo['amount'], 8);
            }
	    }
		return $this->balance;
	}
	
	
	public function getbalance($address)
	{
	    $this->balance = 0;
	    $this->address = $address;
	    $utxos = $this->bitcoin->listunspent(1, 9999999, [$this->address]);
	    if(!empty($utxos)){
	        foreach($utxos as $utxo){
            	$this->balance = bcadd($this->balance, $utxo['amount'], 8);
            }
	    }
	    return $this->balance;
	}
	
	public function getbalancebyAcount($label=null)
	{
		return $this->bitcoin->getbalance($label);
	}

	public function getUnconfirmedBalance($address)
	{
	    $this->balance = 0;
	    $this->address = $address;
	    $utxos = $this->bitcoin->listunspent(0, 9999999, [$this->address]);
	    if(!empty($utxos)){
	        foreach($utxos as $utxo){
            	$this->balance = bcadd($this->balance, $utxo['amount'], 8);
            }
	    }
	    return $this->balance;
	}

	public function getTransactions($account){
		return $this->bitcoin->listtransactions($account);
	}
	
	public function listReceivedbyAddress(){
		return $this->bitcoin->listreceivedbyaddress(1, false);
	}
	
	public function listReceivedbyAccount(){
		return $this->bitcoin->listreceivedbyaccount();
	}
	public function listTransactions($account=null){
		if(!is_null($account))
			return $this->bitcoin->listtransactions($account);
		else 
			return $this->bitcoin->listtransactions();
			
	}
	
	
	public function getTransaction($txid){
		return $this->bitcoin->gettransaction($txid);
	}
	public function getreceivedbyAddress($addr){
		return $this->bitcoin->getreceivedbyaddress($addr);
	}
	
	public function getaccountAddress($lable){
		return $this->bitcoin->getaccountaddress($lable);
	}
	
	public function getAccount($addr){
		return $this->bitcoin->getaccount($addr);
	}
	
	public function getrawtransaction($txid){
		return $this->bitcoin->getrawtransaction($txid);
	}
	
	public function listAccounts(){
		return $this->bitcoin->listaccounts();
	}

	
	
}

?>