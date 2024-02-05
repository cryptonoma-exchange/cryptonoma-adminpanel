<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Ripple 
{	
	private $ch1;
	private $params1;
	private $result1;
	private function _callxrp($params1){
		$this->ch1 = curl_init();
		$this->params1 = $params1;
		$url = config("services.node.XRP");
		curl_setopt($this->ch1, CURLOPT_URL, $url);
		curl_setopt($this->ch1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch1, CURLOPT_POST, 1);
		curl_setopt($this->ch1, CURLOPT_POSTFIELDS, json_encode($this->params1));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($this->ch1, CURLOPT_HTTPHEADER, $headers);
		$this->result = curl_exec($this->ch1);
		if (curl_errno($this->ch1)) {
			echo 'Error:' . curl_error($this->ch1);
		}
		curl_close($this->ch1);
		return json_decode($this->result);
	}	
	
	
	// create address
	public function createaddress_xrp(){
		$params = array("method" => "create_address");
		if(!empty($params)){
			return $this->_callxrp($params);
		}
	}
	
	// send bitcoin
	public function sendxrp($to, $amount, $from=null,$pvtkey, $tag=null){		
		$params = array(
			"method" => "send_xrp",
			"fromaddress" => $from,
			"secret" => $pvtkey,
			"to_address" => $to,
			"amount" => $amount,
			"xrptag" => $tag
		);
		if(!empty($params)){
			$result = $this->_callxrp($params);
			Log::channel("cold_wallet_move")->info(json_encode([
				'from_address' => $from,
				'to_address' => $to,
				'tag' => $tag,
				'amount' => $amount,
				"coin" => "XRP"
			]));
			Log::channel("cold_wallet_move")->info(json_encode($result));
			return $result;	
		}
	}
	
	public function getBalancexrp($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/balance";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}else{
			return 0;
		}
	}
	
}
?>