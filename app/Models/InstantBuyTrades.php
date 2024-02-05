<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstantBuyTrades extends Model
{
	protected $table = 'instantbuytrades';
	
    public static function buyTradesHistory($tradepair)
    {
    	$history = InstantBuyTrades::on('mysql2')->where('pair', $tradepair)->orderBy('price', 'desc')->paginate(15);

    	return $history;
    }

     public static function buyTradesHistory_user($uid)
    {
        $history = InstantBuyTrades::on('mysql2')->where('uid',$uid)->orderBy('price', 'desc')->paginate(15);

        return $history;
    }

    public function userDetails() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
    public function pair_get() {
        return $this->belongsTo('App\Models\Tradepair', 'pair', 'id');
    }
}
