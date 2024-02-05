<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\Selltrade;
use App\Models\Buytrade;
use App\Models\KycSubmit;
use App\Models\Supportchat;
use App\Models\Tickets;
use App\Models\CoinWithdraw;
use App\Models\CryptoTransactions;
use App\Models\UserWallet;
use App\Models\Countries;
use App\Models\SumsubKyc;
use App\Models\AdminProfile;
use App\Models\Kyc;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql2';
    protected $table = 'bitcoinx_users';


    public static function dashboard()
    {
        $totalusers = User::on('mysql2')->count();  //->whereMonth('created_at', Carbon::now()->month)
        $blockusers = User::on('mysql2')->where('status', '=', 1)->count(); //->whereMonth('created_at', Carbon::now()->month)
        $kycverify = User::on('mysql2')->where('kyc_verify', '=', 1)->count(); //->whereMonth('created_at', Carbon::now()->month)
        $chat = Supportchat::on('mysql2')->where('admin_status', '=', 0)->count(); //->whereMonth('created_at', Carbon::now()->month)
        $completeselltrade = Selltrade::on('mysql2')->where('status', '=', 1)->count(); //->whereMonth('created_at', Carbon::now()->month)
        $completebuytrade = Buytrade::on('mysql2')->where('status', '=', 1)->count(); //->whereMonth('created_at', Carbon::now()->month)

        $buytrade = Buytrade::on('mysql2')->where('status', '=', 0)->count(); //->whereMonth('created_at', Carbon::now()->month)
        $selltrade = Selltrade::on('mysql2')->where('status', '=', 0)->count(); //->whereMonth('created_at', Carbon::now()->month)

        $completedtrade = $completeselltrade + $completebuytrade;

        $kyc_users = Kyc::where('status', '=', 0)->orderBy('kyc_id', 'desc')->limit(10)->get();
        $deposit_request = Fiattransactions::where('type','deposit')->where('status',0)->orderBy('id','desc')->limit(10)->get();

        $crypto_withdraw_requests = CryptoTransactions::with(["user"])->where('txtype','withdraw')
        ->where('status', '=', 0)
        ->latest()
        ->limit(10)
        ->get()
        ->map(function($request){
            $request->coin_type = "crypto";
            $request->view_link = url('/admin/crypto_withdraw_edit' . '/' . Crypt::encrypt($request->id));
            return $request;
        });
        $fiat_withdraw_requests = Fiattransactions::where('type','withdraw')
        ->where('status',0)
        ->orderBy('id','desc')
        ->limit(10)
        ->get()
        ->map(function($request){
            $request->coin_type = "fiat";
            $request->view_link = url('/admin/withdraw_edit' . '/' . Crypt::encrypt($request->id));
            return $request;
        });

        $withdraw_request = $crypto_withdraw_requests->merge($fiat_withdraw_requests)->sortByDesc("created_at");

        $support_ticket = Tickets::on('mysql2')->orderBy('id', 'desc')->limit(10)->get();
        $AdminProfiledetails = AdminProfile::adminprofile();
        $details = array(
            'totalusers' => $totalusers,
            'kycverify' => $kycverify,
            'completeselltrade' => $completeselltrade,
            'completebuytrade' => $completebuytrade,
            'completedtrade' => $completedtrade,
            'buytrade' => $buytrade,
            'selltrade' => $selltrade,
            'chat' => $chat,
            'kyc_users' => $kyc_users,
            'withdraw_request' => $withdraw_request,
            'deposit_request' => $deposit_request,
            'support_ticket' => $support_ticket,
            'blockusers' => $blockusers,
            'AdminProfiledetails' => $AdminProfiledetails,
        );

        return $details;
    }

    public static function index()
    {
        $users = User::on('mysql2')->orderBy('id', 'desc')->paginate(100);

        return $users;
    }

    public static function find($id)
    {
        $user = User::where('id', '=', $id)->first();

        return $user;
    }

    public static function userUpdate($request)
    {
        $user_id = $request->id;
        $emailcheck = $request->emailcheck;
        if (isset($request->user_status)) {
            $user_status = $request->user_status;
        } else {
            $user_status = 0;
        }

        if (!empty($request->deleted)) {
            $deleted = 1;
        } else {
            $deleted = 0;
        }

        if (isset($request->reason_block)) {
            $reason_block = $request->reason_block;
        } else {
            $reason_block = '';
        }

        User::where('id', $user_id)->update([
            'email_verify' => $emailcheck, 
            'status' => $user_status, 
            'reason' => $reason_block, 
            'deleted' => $deleted
        ]);
    }

    public static function userWalletDetails($id)
    {
        $btcAddress = '';
        $ethAddress = '';
        $xrpAddress = '';

        $details = array(
            'BTC' => $btcAddress,
            'ETH' => $ethAddress,
            'XRP' => $xrpAddress,
        );

        return $details;
    }

    public static function user_name_search($status, $q)
    {

        $result = User::where(function ($query) use ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->orWhere('email', 'LIKE', '%' . $q . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(15);


        return $result;
    }
}
