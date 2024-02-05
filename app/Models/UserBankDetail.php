<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
	protected $table = 'user_bank_details';
    protected $connection = 'mysql';
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
    public static function CreateuserBank($user){
    	$data = UserBankDetail::where('user_id',$user->uid)->first();
    	if(!$data){
    		$data = new UserBankDetail();
	    	$data->user_id 	= $user->id;
    	}
    	$data->bank_name 		= $user->bank_name;
    	$data->swift_code 		= $user->swift_code;
    	$data->account_no 		= $user->account_number;
    	$data->branch_street 	= $user->bank_street;
    	$data->branch_city 		= $user->branch_city;
    	$data->branch_zipcode 	= $user->branch_zip;
    	$data->branch_country 	= $user->country;
    	$data->created_at 		= $user->created_at;
    	$data->updated_at 		= date('Y-m-d H:i:s',time());
    	$data->save();
    	return $data;

    }
}
