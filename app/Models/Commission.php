<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'bitcoinx_commissions';
    protected $guarded = [];
    protected $connection = 'mysql2';

    
    public static function index()
    {
    	$commission = Commission::on('mysql2')->paginate(12);

    	return $commission;
    }

    public function networks()
    {
        return $this->hasMany(TokenMultinetwork::class,"coin_id","id");
    }

    public static function coindetails($coin)
    {
        $commission = Commission::on('mysql2')->where('source', $coin)->first();
        return $commission;
    }

    public static function edit($id)
    {
    	$commission = Commission::on('mysql2')->where('id', $id)->first();

    	return $commission;
    }

    public static function commissionUpdate($request)
    {
    	$commission = Commission::on('mysql2')->where('id', $request->id)->where('source',$request->currency)->first();
		if($commission){
			$commission->withdraw  = $request->withdraw;
			$commission->buy_trade = $request->buy; 
			$commission->sell_trade = $request->sell;
			$commission->min_deposit = $request->min_deposit;
			$commission->min_withdraw = $request->min_withdraw;
			$commission->min_trade_price = $request->min_trade_price;
            $commission->netfee = $request->netfee;
			$commission->save();
		}

        return true;   
    }
}
