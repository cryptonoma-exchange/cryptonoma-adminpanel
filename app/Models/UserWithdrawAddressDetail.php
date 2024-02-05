<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserWithdrawAddressDetail extends Model
{
    protected $table = 'user_withdraw_address_details';
    protected $connection = 'mysql';
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
    public static function CreateuserWithdrawAddress($uid,$currency,$address,$created_at){


    	$data = UserWithdrawAddressDetail::where(['user_id'=> $uid ,'currency' => $currency])->first();
    	if(!$data){
    		$data = new UserWithdrawAddressDetail();
	    	$data->user_id 	= $uid;
    	}
    	$data->currency 	= $currency;
    	$data->address 		= $address;
    	$data->created_at 	= $created_at;
    	$data->updated_at 	= date('Y-m-d H:i:s',time());
    	$data->save();
    	return $data;

    }
}
