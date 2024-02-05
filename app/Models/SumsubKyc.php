<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumsubKyc extends Model
{
    protected $table = 'sumsubkyc'; 
	protected $connection = "mysql2";

    public static function index()
    {
    	$kyc = SumsubKyc::orderBy('id','desc')->paginate(10);
    	return $kyc;
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
