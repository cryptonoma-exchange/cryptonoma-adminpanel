<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Bep 
{
	public function getBepBalance($address)
	{
		$apikey = config("services.BSCSCAN_API_KEY");
		$url = "https://api.bscscan.com/api?module=account&action=balance&address=".$address."&apikey=".$apikey;
		$balance = $this->bnbcUrl($url);
		return $balance;
	}

	public function getBepTransaction($address)
	{
		$apikey = config("services.BSCSCAN_API_KEY");
		$url = "https://api.bscscan.com/api?module=account&action=txlist&address=".$address."&startblock=0&endblock=99999999&sort=desc&apikey=".$apikey;
	    $balance = $this->bnbcUrl($url);
	    return $balance;
	}

	public function getBepInternalTransaction($address)
	{
		$apikey = config("services.BSCSCAN_API_KEY");
		$url = "https://api.bscscan.com/api?module=account&action=txlistinternal&address=".$address."&startblock=0&endblock=99999999&sort=desc&apikey=".$apikey;
	    $balance = $this->bnbcUrl($url);
	    return $balance;
	}

	public function bnbcUrl($url)
	{
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

	public function bepWithdrawSendTransaction($fromaddress, $toaddress, $amount, $pvk)
	{
	    $ch = curl_init();
		$params = array(
			"method" => "create_bnbtx",
			"formaddr" => $fromaddress,
			"pvk" => $pvk,
			"toddr" => $toaddress,
			"amount" => $amount,
			"url" => "https://bsc-dataseed.binance.org/"
		);
    $node = config("services.node.BNB");
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
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
    Log::channel("cold_wallet_move")->info(json_encode([
			'from_address' => $fromaddress,
			'to_address' => $toaddress,
			'amount' => $amount,
			"coin" => "BNB"
		]));
		Log::channel("cold_wallet_move")->info($result);
		return json_decode($result);
	}

	public function Bep20TokenSendTransaction($fromaddress, $toaddress, $amount, $pvk, $contractaddress)
	{        
		$length = strlen($pvk);
		if($length == 62){
			$pvk = '00'.$pvk;
		}
		$node = config("services.node.BNB");
		$path = base_path().'/app/Helpers/erc20TokenAbiArray.json';
		$abiarray = file_get_contents($path);
	  $ch = curl_init();
		$params = array(
			"method" => "create_beptx",
			"formaddr" => $fromaddress,
			"pvk" => $pvk,
			"toddr" => $toaddress,
			"amount" => $amount,
			"contract"      => $contractaddress,
			"abiarray"      => $abiarray,
			"url" => "https://bsc-dataseed.binance.org/"
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
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		Log::channel("cold_wallet_move")->info("--------BEP20 Token----------");
		Log::channel("cold_wallet_move")->info(json_encode([
			'from_address' => $fromaddress,
			'to_address' => $toaddress,
			'amount' => $amount
		]));
		Log::channel("cold_wallet_move")->info($result);
		Log::channel("cold_wallet_move")->info("---------------------");
		return json_decode($result);
	}
}
