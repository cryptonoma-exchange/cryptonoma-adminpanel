<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserKyc;

class KycSubmit extends Model
{
    protected $table = 'bitcoinx_kyc';
    protected $connection = 'mysql2';

    public static function index()
    {
    	$kyc = KycSubmit::on('mysql2')->orderBy('kyc_id','desc')->paginate(10);

    	return $kyc;
    }

   	public static function edit($id)
    {
    	$kyc = KycSubmit::on('mysql2')->where('kyc_id',$id)->first();

    	return $kyc;
    }

    public static function updateKyc($request)
    { 
         //dd($request);
        $kyc_id = $request->kyc_id; 
        $status = $request->status;
        $remark = $request->remark;
        $uid = $request->uid;

        if($status == 1){
            $kyc_verify = 1;
         

        } elseif($status == 2){
            $kyc_verify = 0;
        } else {
           $kyc_verify = 2; 
        }

        KycSubmit::on('mysql2')->where('kyc_id', $kyc_id)->update(['status' => $status,'remark' => $remark]);

        User::on('mysql2')->where('id', $uid)->update(['kyc_verify' => $kyc_verify]); 
        
        return true; 
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
