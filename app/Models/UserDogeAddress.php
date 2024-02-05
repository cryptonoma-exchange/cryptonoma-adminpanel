<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDogeAddress extends Model
{

	protected $table ='bitcoinx_user_doge_addresses';
    public static function getAddress($uid){
        $address = UserDogeAddress::where(['user_id' =>$uid])->value('address');
        return $address;
    }
    
    public static function addressDelete($uid){
    	$address = UserDogeAddress::where(['user_id' =>$uid])->delete();
        return true;
    }
}