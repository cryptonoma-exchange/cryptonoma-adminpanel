<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTrxAddress extends Model
{


	protected $table ='bitcoinx_user_trx_addresses';

	
    public static function getAddress($uid){
        $address = UserTrxAddress::where(['user_id' =>$uid])->value('address');
        return $address;
    }
    
    public static function addressDelete($uid){
    	$address = UserTrxAddress::where(['user_id' =>$uid])->delete();
        return true;
    }
}