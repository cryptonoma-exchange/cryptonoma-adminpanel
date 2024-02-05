<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUsdtAddress extends Model
{
    public static function getAddress($uid){
        $address = UserUsdtAddress::where(['user_id' =>$uid])->value('address');
        return $address;
    }

    public static function getUserid($address){
        $user_id = UserUsdtAddress::where(['address' =>$address])->value('user_id');
        return $user_id;
    }

    public static function addressDelete($uid){
    	$address = UserUsdtAddress::where(['user_id' =>$uid])->delete();
        return true;
    }

    public function userdetilas() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
