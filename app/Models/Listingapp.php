<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listingapp extends Model
{
	 protected $connection = 'mysql2';
	 protected $table = 'bitcoinx_listapp';

	   public static function listdata()
    {
    	$kyc = Listingapp::on('mysql2')->orderBy('id','desc')->paginate(10);;

    	return $kyc;
    }

        public static function edit($id)
    {
    	$commission = Listingapp::on('mysql2')->where('id', $id)->first();

    	return $commission;
    }
}