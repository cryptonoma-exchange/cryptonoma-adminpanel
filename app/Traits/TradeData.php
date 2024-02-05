<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use codenixsv\Bittrex\BittrexManager;


trait TradeData
{
    //Bitterex Liquidity
  public function bittrexlogin(){
    $manager = new BittrexManager('4710149643154296b61c6bbb51164381', 'c1c8cceb1e514de4aebc981d1b71c01e');
    $client = $manager->createClient();
    return $client;
  }

 
  public function getBalance(){
    $client = $this->bittrexlogin();
    $responce = json_decode($client->getBalances());                           
    return $responce;
  }
}