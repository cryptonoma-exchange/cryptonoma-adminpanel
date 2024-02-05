<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    protected $table = 'user_kycs';
    protected $connection = 'mysql';
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
    public static function CreateuserKycs($user){
    	$data = UserKyc::where('user_id',$user->uid)->first();
    	if(!$data){
    		$data = new UserKyc();
	    	$data->user_id 	= $user->id;
    	}
    	$data->id_type 			= $user->personalid;
    	$data->address_type 	= $user->addresstype;
    	$data->id_proof 		= $user->document;
    	$data->address_proof 	= $user->address_document;
    	$data->created_at 		= $user->created_at;
    	$data->updated_at 		= date('Y-m-d H:i:s',time());
    	$data->save();
    	return $data;
    }
}
