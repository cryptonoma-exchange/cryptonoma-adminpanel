<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXrpAddress extends Model
{
    protected $table = 'bitcoinx_user_xrp_addresses';

    protected $fillable = [
        'user_id', 'address', 'narcanru','balance'
    ];

    public static function getAddress($uid){
        $address = UserXrpAddress::where(['user_id' =>$uid])->value('address');
        return $address;
    }

    public static function addressDelete($uid){
    	$address = UserXrpAddress::where(['user_id' =>$uid])->delete();
        return true;
    }

    public static function getUserID($destinationtag){
        $uid = UserXrpAddress::where(['narcanru' => $destinationtag])->value('user_id');
        return $uid;
    }
}
