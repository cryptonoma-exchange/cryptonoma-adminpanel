<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Ethereum 
{	
	// create address
	public function eth_user_address_create(){
		$url = "https://api.blockcypher.com/v1/eth/main/addrs";
		$result = $this->exec_addr_cUrl($url);
		if($result)
		{
			return $result;
		}
	}

	public function exec_addr_cUrl($url){
		$ch = curl_init();
		$node = config("services.node.ETH");
		curl_setopt($ch, CURLOPT_URL, $node);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
		if (curl_errno($ch)) {
			$result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}
	
	public function cUrl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if (curl_errno($ch)) {
			$result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}

	public function cUrls($url, $postfilds=null)
	{
		$this->url = $url;
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $this->url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		if(!is_null($postfilds)){
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postfilds);
		}
		if(strpos($this->url, '?') !== false){
			curl_setopt($this->ch, CURLOPT_POST, 1);
		}
		$headers = array('Content-Length: 0');
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		if (curl_errno($this->ch)) {
			$this->result = 'Error:' . curl_error($this->ch);
		} else {
			$this->result = curl_exec($this->ch);
		} 
		curl_close($this->ch);
		return json_decode($this->result, true);
	}
	
	public function exec_cUrls($url, $postfilds=null)
	{
		$this->url = $url;
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $this->url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		if(!is_null($postfilds)){
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postfilds);
		}
		if(strpos($this->url, '?') !== false){
			curl_setopt($this->ch, CURLOPT_POST, 1);
		}
		$headers = array('Content-Length: 0');
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		if (curl_errno($this->ch)) {
			$this->result = 'Error:' . curl_error($this->ch);
		} else {
			$this->result = curl_exec($this->ch);
		} 
		curl_close($this->ch);
		return json_decode($this->result, true);
	}
	
	public function getEthBalance($address)
	{
		$url = "https://api.etherscan.io/api?module=account&action=balance&address=".$address;
		$balance = $this->cUrl($url);
		return $balance;
	}

	public function getLivePrice()
	{
		$default_gas_fee = 350*pow(10,8);
		try {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://ethgasstation.info/api/ethgasAPI.json',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response, true);
			$gas_fee = $response["average"];
			if (!empty($gas_fee)) {
				$default_gas_fee = $gas_fee*pow(10,8);
			}
		} catch (\Throwable $th) {
			return $default_gas_fee;
		}
		return $default_gas_fee;
	}
	
	function weitoeth($amount){
		return ncDiv($amount,pow(10,18));
	}
	
	public function getEthTransaction($address)
	{
		$url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$address."&startblock=0&endblock=99999999&sort=asc";
	    $balance = $this->cUrls($url);
	    return $balance;
	}

	public function getEthInternalTransaction($address)
	{
		$url = "http://api.etherscan.io/api?module=account&action=txlistinternal&address=".$address."&startblock=0&endblock=99999999&sort=asc";
	    $balance = $this->cUrls($url);
	    return $balance;
	} 
	
	public function ethSendTransaction($fromaddress, $toaddress, $eth_amount, $pvk, $gasPrice)
	{
		$node = config("services.node.ETH");
		$apiKey = config("services.INFURA_API_KEY");
		$ch = curl_init();
		$params = array(
			"method" => "create_rawtx",
			"formaddr" => $fromaddress,
			"pvk" => $pvk,
			"toddr" => $toaddress,
			"amount" => $eth_amount,
			"gasPrice" => $gasPrice,
			"url" => "https://mainnet.infura.io/v3/$apiKey"
		);
		curl_setopt($ch, CURLOPT_URL, $node);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			return "";
		}
		curl_close($ch);
		Log::channel("cold_wallet_move")->info(json_encode([
			'from_address' => $fromaddress,
			'to_address' => $toaddress,
			'amount' => $eth_amount,
			"coin" => "ETH"
		]));
		Log::channel("cold_wallet_move")->info($result);
		return json_decode($result);
	}

	public function sendErc20Token($privateKey,$gasPrice,$gasLimit,$contract,$amount,$from_address,$toAddress){
		$node = config("services.node.ETH");
		$apiKey = config("services.INFURA_API_KEY");
		$path = base_path().'/app/Helpers/erc20TokenAbiArray.json';
		$abi = file_get_contents($path);
		$params = array(
			"method" => "create_rawcustomtx",
			'formaddr' => $from_address,
			"pvk" => $privateKey,
			'toddr' => $toAddress,
			'amount' => $amount,
			'contract'=> $contract,
			"gasPrice" => $gasPrice,
			"gasLimit" => $gasLimit,
			"abi" => $abi,
			"url" => "https://mainnet.infura.io/v3/$apiKey"
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $node);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			return "";
		}
		curl_close($ch);
		Log::channel("cold_wallet_move")->info("--------ERC20 Token----------");
		Log::channel("cold_wallet_move")->info(json_encode([
			'from_address' => $from_address,
			'to_address' => $toAddress,
			'amount' => $amount
		]));
		Log::channel("cold_wallet_move")->info($result);
		Log::channel("cold_wallet_move")->info("---------------------");
		return json_decode($result);
		
	}
 
}
?>