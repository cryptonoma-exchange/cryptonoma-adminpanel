<?php
namespace App\Traits;

trait Bitcoin 
{	
	private $ch;
	private $params;
	private $result;
	private $url = "https://insight.bitpay.com/api/";
	private function _call($params){
		$this->ch = curl_init();
		$this->params = $params;
		$node = config("services.node.BTC");
		curl_setopt($this->ch, CURLOPT_URL, $node);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$this->result = curl_exec($this->ch);
		if (curl_errno($this->ch)) {
			echo 'Error:' . curl_error($this->ch);
		}
		curl_close($this->ch);
		//dd("ok");
		return json_decode($this->result);
	}
	
	private function sathosi($amount){
		if(!empty($amount)){
			return 100000000 * $amount;
		}
	}
	
	private function sathositobtc($amount){
		if($amount != 0){
			if(!empty($amount)){
				return bcdiv($amount, 100000000, 8);
			}
		} else {
			return $amount;
		}
	}
	
	// create address
	public function createaddress_btc(){
		$params = array("method" => "create_address");
		if(!empty($params)){
			return $this->_call($params);
		}
	}
	
	public function createmsigaddress(){
		$params = array("method" => "create_multisig_address");
		if(!empty($params)){
			return $this->_call($params);
		}
	}
	
	// send bitcoin
	public function sendBtc($to_address, $amount, $from = null, $pvtkey, $fee = null){
		//amount & fee
		$amount = $this->sathosi($amount);
		$amount = number_format($amount, 0, '.', '');

		$fee = $this->sathosi($fee);
		$fee = number_format($fee, 0, '.', '');

		$utxo = $this->utxo($from);
		$utxo_tx = array();
		if (isset($utxo['unspent_outputs']) && count($utxo['unspent_outputs']) > 0) {
			foreach ($utxo['unspent_outputs'] as $is_data) {
				$utxo_tx[] = array(
					'txid' => $is_data['tx_hash_big_endian'],
					'address' => $from,
					'outputIndex' => $is_data['tx_output_n'],
					'satoshis' => $is_data['value'],
					'confirmations' => $is_data['confirmations'],
					'script' => $is_data['script'],
				);
			}
		}
		$prepared_utxo = json_encode($utxo_tx);

		if (!empty($utxo) && isset($utxo) && !empty($prepared_utxo)) {
			$params = array(
				"method" => "create_rawtx",
				"fromaddr" => $from,
				"privatekey" => $pvtkey,
				"toaddr" => $to_address,
				"amount" => (int)$amount,
				"fee" => (int)$fee,
				"utxo" => $prepared_utxo
			);

			if (!empty($params)) {
				$rawtx = $this->_call($params);
				if (!empty($rawtx)) {
					return $this->sendraw_tx($rawtx->rawtx);
				}
			}
		}
	}
	
	private function sendraw_tx($rawtx){
		if(!empty($rawtx)){
			$btcurl = "https://api.blockcypher.com/v1/btc/main/txs/push?token=";
			$ch = curl_init();
			$params = json_encode(array(
				"tx" => $rawtx
			));
			curl_setopt($ch, CURLOPT_URL, $btcurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_POST, 1);
			$headers = array();
			$headers[] = "Accept: application/json, text/plain";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			if(curl_errno($ch)) {
				echo $result = 'Error:' . curl_error($ch);
			} else {
				$result = curl_exec($ch);
			}
			curl_close($ch);
			return json_decode($result);
		}
	}
	
	private function utxo($address){
		if(!empty($address)){
			$url = "https://blockchain.info/unspent?active=".$address;
			return $this->execCurl($url);
		}
	}
	
	public function tx($txid){
		if(!empty($txid)){
			$url = $this->url."tx/$txid";
			return json_decode($this->cUrl1($url));
		}
	}
	public function getBtcTransactions($address, $from=null, $to=null){
		if(!empty($address)){
			$url = "https://chain.api.btc.com/v3/address/".$address."/tx";
			return json_decode($this->cUrl1($url));
		}
	}
	
	public function getBtcBalance($address){
		if(!empty($address)){
		    $url = $this->url."addr/".$address."/balance";
			$balance = $this->execCurl($url);
			return $balance;
		}else{
			return 0;
		}
	}
	
	public function totalReceived($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/totalReceived";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}
	
	public function totalSent($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/totalSent";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}
	
	public function unconfirmedBalance($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/unconfirmedBalance";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}
	
	private function cUrl1($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$headers = array();
		$headers[] = "Accept: application/json, text/plain";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if (curl_errno($ch)) {
			echo $result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		curl_close($ch);
		return $result;
	}
	
	public function execCurl($url)
    {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$headers = array();
		$headers[] = "Accept: application/json, text/plain";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if (curl_errno($ch)) {
			echo $result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
    }
}
?>