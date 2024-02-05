<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Liquidity extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'bitcoinx_liquiditys'; 

//  public static function adminprofile() {
//     $adminid = Session::get('adminId');
//     $admin = AdminProfile::where(['user_id' => $adminid])->first();  
//     return $admin;
// }
public static function index()
{
    $liquidity = Liquidity::on('mysql2')->orderBy('id', 'desc')->get();
    
    return $liquidity;
}
public static function liquidityadd($request)
{ 
    if($request->name !="" && $request->apikey !=""  && $request->secretkey !="")
    {
         
        $liquidity = new Liquidity(); 
        $liquidity->name = $request->name;
        $liquidity->apikey = $request->apikey;
        $liquidity->secretkey = $request->secretkey;
        $liquidity->save();
    }
}


public static function edit($id)
{
    $liquidity = Liquidity::on('mysql2')->where('id',$id)->first(); 
 
   //dd($liquidity);
    return $liquidity;
   
}

public static function updateliq($request)
{   

   // dd($request);
  if($request->name !="" && $request->apikey !=""  && $request->secretkey !="")
    {
        $pairs = Tradepair::where("type",1)->get();
        $exchangeInfo = binance()->exchangeInfo();
        $symbols = $exchangeInfo["symbols"];
        foreach ($pairs as $pair) {
            $pair_string = $pair->coinone_binance.$pair->cointwo_binance;
            if(isset($symbols[$pair_string])){
                $info = $symbols[$pair_string];
                $filters = collect($info["filters"]);
                $LOT_SIZE = $filters->where("filterType","LOT_SIZE")->first();
                $stepSize = $LOT_SIZE["stepSize"];
                $pair->step_size = $stepSize;
                $pair->save();
            }
        }
        $liquidity = Liquidity::on('mysql2')->where('id',$request->id)->first(); 
        $liquidity->name = $request->name;
        $liquidity->apikey = $request->apikey;
        $liquidity->secretkey = $request->secretkey;
        if($request->testnet){
            $liquidity->testnet = 1;
        } else {
            $liquidity->testnet = 0;
        }
        $liquidity->save(); 
    }
}

}