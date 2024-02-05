<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstantSellTrades extends Model
{
	protected $table = 'instantselltrades';
	
    public static function sellTradesHistory($tradepair)
    {
    	$history = InstantSellTrades::on('mysql2')->where('pair',$tradepair)->orderBy('price', 'desc')->paginate(15);

    	return $history;
    }

    public static function sellTradesHistory_user($uid)
    {
        $history = InstantSellTrades::on('mysql2')->where('uid',$uid)->orderBy('price', 'desc')->paginate(15);

        return $history;
    }
    public function userDetails() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
    public function pair_get() {
        return $this->belongsTo('App\Models\Tradepair', 'pair', 'id');
    }
}
