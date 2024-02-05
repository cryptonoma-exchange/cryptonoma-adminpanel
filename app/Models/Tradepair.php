<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Tradepair extends Model
{
    protected $table = 'bitcoinx_tradepairs';

    protected $connection = 'mysql2';


    public static function index($pair, $pair2)
    {
    	$details = Tradepair::on('mysql2')->where([['coinone', '=', $pair],['cointwo', '=', $pair2]])->orderBy('id', 'asc')->first();

    	return $details;
    }

    public static function pair()
    {
    	$pairs = Tradepair::on('mysql2')->orderBy('coinone', 'asc')->get();

    	return $pairs;
    }

 



}
