<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
class Bank extends Model
{
    protected $table = 'bitcoinx_mpesa';
    protected $connection = 'mysql2';
   // protected $guarded = [];
   protected $fillable = ['shortcode', 'passkey','id']; 



    // public static function index($fiat)
    // {
    //     $bank = Mpesa::on('mysql2')->where('currency',$fiat)->orderBy('id', 'desc')->get();
        
    //     return $bank;
    // }
    // public static function bankadd($request)
    // { 
    //     if($request->coin !="" && $request->bank_name !=""  && $request->accounttype !="" && $request->accountname !="" && $request->accountno !="" )
    //     {
             
    //         $bank = new Bank(); 
    //         $bank->currency = $request->coin;
    //         $bank->is_admin = 1;
    //         $bank->uid = 0;
    //         $bank->account_name = $request->accountname;
    //         $bank->account_no = $request->accountno;
    //         $bank->accounttype = $request->accounttype;
    //         $bank->bank_name = $request->bank_name;

    //         $bank->abanoadmin = $request->abano;
    //         $bank->swiftcodeadmin = $request->swiftcode;
    //         $bank->bankstreetaddress = $request->bankstreetaddress;
    //         $bank->citystate = $request->city;
    //          $bank->countryregion = $request->country;
    //         $bank->save();
    //     }
    // }


    // public static function edit($id)
    // {
    //     $bank = bank::on('mysql2')->where('id',$id)->first(); 
    //     // dd($bank);
    //     return $bank;
    // }

    // public static function bankUpdate($request)
    // {   
 
    //   // dd($request);
    //     if($request->coin !="" && $request->bank_name !=""  && $request->accounttype !="" && $request->account_name !="" && $request->account_no !="" )
    //     {
    //         $bank = Bank::on('mysql2')->where('id',$request->id)->first(); 
    //         $bank->currency = $request->coin; 
    //         $bank->account_name = $request->account_name;
    //         $bank->account_no = $request->account_no;
    //         $bank->accounttype = $request->accounttype;
    //         $bank->bank_name = $request->bank_name;
    //          $bank->abanoadmin = $request->abano;
    //         $bank->swiftcodeadmin = $request->swiftcode;
    //         $bank->bankstreetaddress = $request->bankstreetaddress;
    //         $bank->citystate = $request->city;
    //          $bank->countryregion = $request->country;
    //         $bank->save(); 
    //     }
  //  }









    
 //    public function user() {
 //        return $this->belongsTo('App\Models\User', 'uid', 'id');
 //    }
	// public function userCountryDetails() {
	// return $this->belongsTo('App\Models\Countries', 'country', 'id');
	
	// }
}
