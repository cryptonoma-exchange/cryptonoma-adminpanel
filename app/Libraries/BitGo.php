<?php
namespace App\Libraries;

class BitGo
{
	private function calldata($params){
		$ch = curl_init();
		$params = $params;
		curl_setopt($ch, CURLOPT_URL, "http://206.189.74.156:9071");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result);
	}
	
	// create address
	public function GenerateAddress($coin,$token,$walletid,$label){
		$params = array("method" => "create_address","coin" => $coin,"token" => $token,"walletid" => $walletid,"label" => $label);
		if(!empty($params)){
			return $this->calldata($params);
		}
	}
	public function GetWalletDetails($coin,$token,$walletid,$addressid){
		$params = array("method" => "getwallet_address","coin" => $coin,"token" => $token,"walletid" => $walletid,"addressid" => $addressid);
		if(!empty($params)){
			return $this->calldata($params);
		}
	}		
}

?>