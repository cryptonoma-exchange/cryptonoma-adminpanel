<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BuySellCommission extends Model
{

    protected $table = 'buy_sell_commissions';
    protected $connection = 'mysql2';

        
     public static function index()
        {
            $commission = BuySellCommission::paginate(10);

            return $commission;
        }

        public static function coindetails($coin)
        {
            $commission = BuySellCommission::where('source', $coin)->first();
            return $commission;
        }

        public static function edit($id)
        {
            $commission = BuySellCommission::where('id', $id)->first();

            return $commission;
        }

        public static function commissionUpdate($request)
        {
            $commission = BuySellCommission::where('id', $request->id)->first();
            $commission->name  = $request->name;
            $commission->source  = $request->source;
            $commission->buy = $request->buyamount; 
            $commission->sell = $request->sellamount; 
            //$commission->buy_commission = $request->buy_commission; 
            //$commission->sell_commission = $request->sell_commission; 
            $commission->save();

            return true;   
        }
}
