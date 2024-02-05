<?php
namespace App\Traits;

trait BitcoinCash 
{	
  private $ch;
  private $params;
  private $result;
  private $bch_url = "https://rest.bch.actorforth.org/v2/";
  private function _call($params){
    $this->ch = curl_init();
    $this->params = $params;
    $node = config("services.node.BCH");
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
    return json_decode($this->result);
  }

    private function _bchcall($params, $object = NULL){
    $this->ch = curl_init();
    $this->params = $params;
    $node = config("services.node.BCH");
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
    if($object != NULL)
    {
      return json_decode($this->result);  
    }
    return json_decode($this->result, true);
  }

    private function _callbch($params){
    $this->ch = curl_init();
    $this->params = $params;
    curl_setopt($this->ch, CURLOPT_URL, "http://localhost:8526");
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
    return json_decode($this->result);
  }
  
  public function sathosi($amount){
    if(!empty($amount)){
      return 100000000 * $amount;
    }
  }
  
  private function sathositobtc($amount){
    if(!empty($amount)){
      return bcdiv($amount, 100000000, 8);
    }
  }
   
  public function createaddress($paw){
    $params = array("method" => "create_address", "mnemonic" => $paw);
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
  
  public function convertCashaddress($address){
    $params = array(
        "method" => "get_bitcash_account",
        "addr" => $address
        );
    if(!empty($params)){
      return $this->_call($params);
    }
  }


  public function Getbchprivatekey($private){
    if(!empty($private)){
      $params = array(
        "method"  => "getprivatekey",
        "mnemonic" => $private,
      );
      return $this->_bchcall($params, 'object');
    }
  }

    public function bch_utxo($address){


    if(!empty($address)){
      $test_bch_url = $this->bch_url."address/utxo/$address";

     
      $utxos = json_decode($this->bch_cUrl($test_bch_url), true);



      if(!empty($utxos)){
        $data = array();
        foreach($utxos['utxos'] as $utxo){
          $data[$utxo['txid']] = $utxo['vout'];
        }
      }
      return json_encode($data);
    }
  }

    private function bch_cUrl($bch_url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $bch_url);
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
   
  public function send($to,$amount,$txid,$from,$pwd,$vout){
    if(!empty($to)){

      $from = 'bitcoincash:'.$from;
      $to = 'bitcoincash:'.$to;
 
      $params = array(
            "method" => "send_bch",
            "toaddress" => $to,
            "amount" => $amount,
            "txid" => $txid,
            "mnemonic"=>$pwd,
            "vout"=>$vout,
          ); 

      return $this->_call($params);
    }
  }

    public function sendbch($to,$amount,$txid,$from,$pwd,$vout){
    if(!empty($to)){

      $from = 'bitcoincash:'.$from;
      $to = 'bitcoincash:'.$to;
 
      $params = array(
            "method" => "send_bch",
            "toaddress" => $to,
            "amount" => $amount,
            "txid" => $txid,
            "mnemonic"=>$pwd,
            "vout"=>$vout,
          ); 

      return $this->_callbch($params);
    }
  }
 
  
  public function getTransactions($address){
    if(!empty($address)){
      $params = array(
            "method" => "get_transactions",
            "addr" => $address
          );
      return $this->_call($params);
    }
  }
  
  public function getBalance($address){
    if(!empty($address)){
      $params = array(
            "method" => "get_balance",
            "address" => $address
          );
      return $this->_call($params);
    }
  }
 
  
  public function totalReceived($address){
    if(!empty($address)){
      $url = $this->url."addr/$address/totalReceived";
      $balance = $this->cUrl($url);
      return $this->sathositobtc($balance);
    }
  }
  
  public function totalSent($address){
    if(!empty($address)){
      $url = $this->url."addr/$address/totalSent";
      $balance = $this->cUrl($url);
      return $this->sathositobtc($balance);
    }
  }
  
  public function unconfirmedBalance($address){
    if(!empty($address)){
      $url = $this->url."addr/$address/unconfirmedBalance";
      $balance = $this->cUrl($url);
      return $this->sathositobtc($balance);
    }
  }
  
  private function cUrl($url){
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

 public function utxo($address){


   if(!empty($address)){
    $url = $this->url."transaction/address/$address";
   
    $utxos = json_decode($this->cUrl($url), true); 


    if(!empty($utxos)){
    $data = array();
      foreach($utxos['utxos'] as $utxo){
      	$data[$utxo['txid']] = $utxo['vout'];
      }
    }
    return json_encode($data);
  }
}
	
}
?>