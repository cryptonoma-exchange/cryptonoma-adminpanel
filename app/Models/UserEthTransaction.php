<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositEmail;
use App\Mail\WithdrawEmail;

class UserEthTransaction extends Model
{
    public static function histroy()
    {
    	$ethWithdraw = UserEthTransaction::on('mysql2')->where('type','send')->orderBy('id','desc')->get();

    	return $ethWithdraw;
    }

    public static function depsoitList()
    {   
    	$list = UserEthTransaction::on('mysql2')->where('type', 'received')->orderBy('id', 'desc')->paginate(10); 
    	
    	return $list;
    }

    public static function depsoitView($id)
    {
    	$list = UserEthTransaction::on('mysql2')->where('id',$id)->first(); 
    	
    	return $list;
    }

    public static function depsoitUpdate($request)
    { 
    	$list = UserEthTransaction::on('mysql2')->where('id',$request->id)->first();

    	if($request->status == 2)
    	{
    		$list->status = 2;
    		$list->save();

    		$balance = UserWallet::on('mysql2')->where('uid',$request->user_id)->where('currency','ETH')->first();

    		if(isset($balance->balance))
    		{
    			$balance->balance = number_format($balance->balance+$request->amount,8);
    			$balance->site_balance = number_format($balance->balance+$request->amount,8);
    			$balance->save();
    		}
    		else
    		{
    			$bal = new UserWallet;
    			$bal->setConnection('mysql2');
    			$bal->uid = $request->user_id;
    			$bal->currency = 'ETH';
    			$bal->escrow_balance = 0;
    			$bal->main_balance = 0;
    			$bal->site_balance = number_format($request->amount,8);
    			$bal->balance = number_format($request->amount,8);
    			$bal->save();
    		} 
    		
    		$status = 'Accept'; 
    	}
    	elseif($request->status == 3)
    	{
    		$list->status = 3;
    		$list->save();

    		$status = 'Cancel';
    	}

        $user = User::on('mysql2')->where('id',$request->user_id)->first(); 
       
    	$details = array(
    			'status'=>$status,
    			'coin'=>'ETH',
    			'amount'=>$request->amount,
                'user' => $user->name 
    			); 
    	
    	Mail::to($user->email)->send(new DepositEmail($details));
    }


    public static function withdraw()
    {   
    	$history = UserEthTransaction::on('mysql2')->where('type','send')->orderBy('id','desc')->get();

    	return $history;
    }

    public static function withdrawEdit($id)
    {
    	$withdraw = UserEthTransaction::on('mysql2')->where('id',$id)->first();

    	return $withdraw;
    } 

    public static function withdrawUpdate($request)
    {
    	$withdraw = UserEthTransaction::on('mysql2')->where('id',$request->id)->first();

        if($request->status == 2)
        { 
            $balanceUpdate = UserWallet::on('mysql2')->where('uid',$withdraw->user_id)->where('currency','ETH')->first(); 
            $balanceUpdate->balance = $balanceUpdate->balance + $withdraw->total_amount;
            $balanceUpdate->site_balance = $balanceUpdate->site_balance + $withdraw->total_amount;
            $balanceUpdate->save(); 

            $withdraw->status = 2 ;
            $withdraw->save();

            $status = 'Cancel';

        }
        elseif($request->status == 1)
        {
            $withdraw->status = 1;
            $withdraw->save();
            
            $status = 'Accept'; 
        } 

        $user = User::on('mysql2')->where('id',$withdraw->user_id)->first(); 
       
        $details = array(
                'status'=>$status,
                'coin'=>'ETH',
                'amount'=>$withdraw->amount,
                'user' => $user->name 
                ); 
        
        Mail::to($user->email)->send(new WithdrawEmail($details));

        return 'Withdrawn status updated successfully';
    }
}
