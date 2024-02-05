<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail; 
use App\Mail\WithdrawEmail; 
use App\Models\Adminwallet;
use App\Models\AdminTransactions;
use App\Models\Commission;


class CoinWithdraw extends Model
{
	protected $table = 'bitcoinx_coin_withdraw';

    public static function histroy($type)
    {
    	$histroy = CoinWithdraw::on('mysql2')->where('coin_name', $type)->orderBy('id', 'desc')->paginate(15);

    	return $histroy;
    }


   public static function userhistroy($id)
    {
        $histroy = CoinWithdraw::on('mysql2')->where('uid', $id)->orderBy('id', 'desc')->paginate(15);

        return $histroy;
    }


    public static function user_histroy($user_id)
    {
        $histroy = CoinWithdraw::on('mysql2')->where('uid', $user_id)->orderBy('id', 'desc')->paginate(15);

        return $histroy;
    }



    public static function edit($id)
    {
    	$histroy = CoinWithdraw::on('mysql2')->where('id', $id)->first();
    	return $histroy;
    }

    public static function withdrawUpdate($request)
    {
        $id         = $request->id;
        $status     = $request->status;
        $currency   = $request->currency;
        $adminfee   = $request->adminfee;
        // dd($commission);
        $deposit_data = CoinWithdraw::on('mysql2')->where(['id' => $request->id,'status' => 0])->first();

        if($deposit_data)
        {
            $coin       = $deposit_data->coin_name;
            $amount     = $deposit_data->amount;
            $admin_fee  = $deposit_data->admin_fee;
            $uid        = $deposit_data->uid;

            if($status == 2)
            {
                $user = UserWallet::on('mysql2')->where('uid',$deposit_data->uid)->where('currency',$coin)->first();
                 $oldbalance  = $user->balance;
                $return_amt         = $amount;
                $user->balance      = ncAdd($user->balance, $return_amt);
                $user->site_balance = ncAdd($user->site_balance, $return_amt);
                $user->save();
                $walletbalance  = $user->balance;
            

                 //Track balance update 
                self::AllcoinUpdateBalanceTrack($uid,$coin,$amount,$walletbalance,$oldbalance,$deposit_data->id);


                $status1 = 'Cancel'; 
            } else {
                $status1 = 'Accept'; 

                //Admin amount
                Adminwallet::admincreditAmount($currency, $amount, $adminfee,NULL);
                //Admin transaction
                $commission= Commission::where(['source' => $currency ])->value('withdraw');
                 AdminTransactions::Createtransaction($uid,'withdraw',$amount,NULL,$amount,$adminfee,$commission);
                
            }

            $deposit_data->status = $status;
            $deposit_data->save();
            
        }

        $user = User::on('mysql2')->where('id',$deposit_data->uid)->first(); 
       
        $details = array(
            'status'    => $status1,
            'coin'      => $coin,
            'amount'    => $deposit_data->amount,
            'user'      => $user->name 
        ); 
        
        Mail::to($user->email)->send(new WithdrawEmail($details));

        return true;
    }

    public static function AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$insertid)
    {

        $Models = '\App\Models\UserTransaction'.$currency;
        $remark = $currency.' Admin Rejected withdraw request';
        $Models::AddTransaction($uid,'withdraw',$amount,0,$walletbalance,$oldbalance,$remark,'Admin',$insertid);

        return true;
    }


    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
