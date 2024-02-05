<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    protected $table = 'users';
    protected $connection = 'mysql';
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    public static function Createuser($user){
    	$data = AdminUsers::where('email',$user->email)->first();
    	if(!$data){
    		$data = new AdminUsers();
	    	$data->user_id 	= $user->id;
	    	$data->email 	= $user->email;
    	}
    	$data->name = $user->name;
    	$data->password = $user->password;
    	$data->google2fa_secret = $user->google2fa_secret;
    	$data->remember_token = $user->remember_token;
    	$data->created_at = $user->created_at;
    	$data->updated_at = date('Y-m-d H:i:s',time());
    	$data->save();
    	return $data;

    }
}
