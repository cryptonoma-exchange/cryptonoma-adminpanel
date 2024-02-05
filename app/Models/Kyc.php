<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserKyc;

class Kyc extends Model
{
    protected $table = 'bitcoinx_kyc';
    protected $connection = 'mysql2';

    public static function index()
    {
    	$kyc = Kyc::latest()->paginate(10);
    	return $kyc;
    }

   	public static function edit($id)
    {
    	$kyc = Kyc::on('mysql2')->where('kyc_id',$id)->first();

    	return $kyc;
    }

    public static function updateKyc($request)
    { 
        
        $kyc_id = $request->kyc_id; 
        $status = $request->status;
        $uid = $request->uid;

        if($status == 1){
            $kyc_verify = 1;
            $insert = new UserKyc;
            $insert->user_id = $uid;
            $insert->email = user($uid)->email;
            $insert->save();

        } elseif($status == 2){
            $kyc_verify = 0;
        } else {
           $kyc_verify = 2; 
        }

        Kyc::on('mysql2')->where('kyc_id', $kyc_id)->update(['status' => $status]);

        User::on('mysql2')->where('id', $uid)->update(['kyc_verify' => $kyc_verify]); 
        
        return true; 
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
