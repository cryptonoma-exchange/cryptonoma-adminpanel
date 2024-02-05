<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXlmAddress extends Model
{

	protected $table ='bitcoinx_user_xlm_addresses';
    public static function getAddress($uid){
        $address = UserXlmAddress::where(['user_id' =>$uid])->value('address');
        return $address;
    }
    
    public static function addressDelete($uid){
    	$address = UserXlmAddress::where(['user_id' =>$uid])->delete();
        return true;
    }
}