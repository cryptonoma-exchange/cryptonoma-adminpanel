<?php
namespace App\Libraries;
use App\Models\Tradepair;
use codenixsv\Bittrex\BittrexManager;

class BittrexLiquity
{
	//Bitterex Liquidity
  public function bittrexlogin(){
    $manager = new BittrexManager('23af27c7a37a41959685848208d15f80', 'e8c97b116e20434aa94c7a93a5affa44');
    $client = $manager->createClient();
    return $client;
  }

  public function liquidityGetOrder($order_id){
    $client = $this->bittrexlogin();
    $responce = json_decode($client->getOrder($order_id));                    
    return $responce;
  }

  public function liquidityOrderBook($pairid){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){      
      $details = json_decode($client->getOrderBook($pair));
      if($details->success == 'true'){
        $buytrades = $details->result;
      }else{
        $buytrades = $details->message;                
      }        
    }else{
      return 'Invalid pair id';
    }
    return $buytrades;
  }

  public function LiquidityMarketHistory($pairid){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = json_decode($client->getMarketHistory($pair));
      if($details->success == 'true'){
        $completedtrade = $details->result;
      }else{
        $completedtrade = $details->message;                
      }        
    }else{
      return 'Invalid pair id';
    }
    return $completedtrade;
  }

  public function liquidityBuyLimitTrade($pairid,$price,$volume){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = json_decode($client->buyLimit($pair,$price,$volume));       
    }else{
      return 'Invalid pair id';
    }
    return $details;
  }

  public function liquiditySellLimitTrade($pairid,$price,$volume){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = json_decode($client->sellLimit($pair,$price,$volume));       
    }else{
      return 'Invalid pair id';
    }
    return $details;
  }

  public function marketpair($pairid){
    $pair = Tradepair::where(['id' => $pairid,'type' => 1 ])->first();
    if($pair){
      $coinone = $pair->coinone;
      $cointwo = $pair->cointwo;
      $market = $cointwo.'-'.$coinone;
      return $market;
    }else{
      return false;
    }
  }
  public function getChartData($pairid,$tickInterval='hour'){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){
      $url = "https://international.bittrex.com/Api/v2.0/pub/market/GetTicks?1563366144&tickInterval=hour&marketName=$pair";            
      $details = json_decode(crul($url)); 
    }else{
      return 'Invalid pair id';
    }
    return $details->result;    
  }
  public function getTicker($pairid){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = $client->getTicker($pair);       
    }else{
      return 'Invalid pair id';
    }
    return $details;    
  }
  //Get the last 24 hour summary of all active exchanges for a market
  public function getMarketSummary($pairid){
    $client = $this->bittrexlogin();
    $buytrades = array();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = json_decode($client->getMarketSummary($pair));      
      $result =  $details->result[0];      
      $exchange = $this->hrExchange($result->Last,$result->PrevDay);
      $data['Last']     = $result->Last;
      $data['Low']      = $result->Low;
      $data['High']     = $result->High;
      $data['Volume']   = $result->Volume;
      $data['Exchange'] = $exchange;
    }else{
      $data = $this->TradePrice($pairid);
    }
    return $data;    
  }

  public function cancelOrder($pairid,$uuid){
    $client = $this->bittrexlogin();
    $pair = $this->marketpair($pairid);
    if($pair){            
      $details = json_decode($client->cancel($uuid));       
    }else{
      return 'Invalid pair id';
    }
    return $details['result'];    
  }
  //Get all balances from your account
  public function getBalance($coin=null){
    $client = $this->bittrexlogin();
    if($coin){            
      $responce = $client->getBalance($coin);       
    }else{
      $responce = $client->getBalances();
    }
    return $responce;    
  }
  //Get or generate an address for a specific currency
  public function getDepositAddress($coin=BTC){
    $client = $this->bittrexlogin();
    if($coin){            
      $responce = $client->getDepositAddress($coin);       
    }else{
      $responce = 'Invalid coin';
    }
    return $responce;    
  }
}


?>