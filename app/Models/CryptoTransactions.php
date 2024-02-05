<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositEmail;
use App\Models\UserWallet;
use App\Mail\WithdrawEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CryptoTransactions extends Model
{
    protected $table = 'bitcoinx_cryptotransactions';
    protected $connection = 'mysql2';


    public static function listView($currency, $type)
    {
        $list = CryptoTransactions::on('mysql2')->where(['txtype' => $type, 'currency' => $currency])->orderBy('id', 'desc')->paginate(10);

        return $list;
    }


    public static function depsoitList($uid, $currency)
    {
        $list = CryptoTransactions::on('mysql2')->where(['uid' => $uid, 'currency' => $currency])->orderBy('id', 'desc')->paginate(10);

        return $list;
    }

    public static function depsoitListall($currency)
    {
        $list = CryptoTransactions::on('mysql2')->where(['currency' => $currency])->orderBy('id', 'desc')->paginate(10);

        return $list;
    }

    public static function userhistroy($id)
    {
        $histroy = CryptoTransactions::on('mysql2')->where('uid', $id)->orderBy('id', 'desc')->paginate(15);

        return $histroy;
    }

    public static function depsoitList_user($uid)
    {
        $list = CryptoTransactions::on('mysql2')->where([
            ['uid', '=', $uid],
            ['txtype', '=', 'deposit']
        ])->orderBy('id', 'desc')->paginate(10);

        return $list;
    }


    public static function depsoitView($id)
    {
        $list = CryptoTransactions::on('mysql2')->where('id', $id)->first();

        return $list;
    }

    public static function depsoitUpdate($request)
    {
        $list = CryptoTransactions::on('mysql2')->where(['id' => $request->id, 'status' => 0])->first();


        if ($list) {
            if ($request->status == 2) {
                $list->status = 2;
                $list->save();
                $balance = UserWallet::on('mysql2')->where(['uid' => $list->uid, 'currency' => $list->currency])->first();

                if (is_object($balance)) {
                    $balance->balance = ncAdd($balance->balance, $request->amount);
                    $balance->site_balance = ncAdd($balance->balance, $request->amount);
                    $balance->save();
                } else {
                    $bal = new UserWallet;
                    $bal->setConnection('mysql2');
                    $bal->uid            = $list->uid;
                    $bal->currency       = $list->currency;
                    $bal->escrow_balance = 0;
                    $bal->site_balance   = $list->amount;
                    $bal->balance        = $list->amount;
                    $bal->save();
                }

                $status = 'Accept';
            } elseif ($request->status == 3) {
                $list->status = 3;
                $list->save();

                $status = 'Cancel';
            } elseif ($request->status == 0) {
                $status = 'Pending';
            }



            $user = User::on('mysql2')->where('id', $list->uid)->first();

            $details = array(
                'status'     => $status,
                'coin'       => $list->currency,
                'amount'     => $request->amount,
                'user'       => $user->name
            );

            Mail::to($user->email)->send(new DepositEmail($details));
            return $list;
        } else {
            return false;
        }
    }
    public static function statusUpdate($request)
    {
        $id = $request->id;
        $amount = $request->amount;
        $status = $request->status;
        $credit_amount = $request->credit_amount;

        $deposit_data = CryptoTransactions::on('mysql2')->where('id', $id)->first();


        if ($deposit_data) {
            if ($status == 1) {
                $updateBal = UserWallet::on('mysql2')->where('uid', $deposit_data->uid)->where('currency', $deposit_data->currency)->first();


                if (isset($updateBal->balance)) {
                    $updateBal->balance = ncAdd($updateBal->balance, $request->credit_amount);
                    $updateBal->site_balance = ncAdd($updateBal->site_balance, $request->credit_amount);
                    $updateBal->save();
                } else {
                    $balance = new UserWallet;
                    $balance->setConnection('mysql2');
                    $balance->uid = $deposit_data->uid;
                    $balance->currency = $deposit_data->currency;
                    $balance->balance = $request->credit_amount;
                    $balance->escrow_balance = 0;
                    $balance->site_balance = $request->credit_amount;
                    $balance->save();
                }

                $status1 = 'Accept';
            } else {
                $status1 = 'Cancel';
            }
            $deposit_data->credit_amount = $request->credit_amount;
            $deposit_data->status = $status;
            $deposit_data->save();
        }

        $user = User::on('mysql2')->where('id', $deposit_data->uid)->first();

        $details = array(
            'status'    => $status1,
            'coin'      => $deposit_data->currency,
            'amount'    => $deposit_data->amount,
            'user'      => $user->name
        );

        Mail::to($user->email)->send(new DepositEmail($details));

        return true;
    }

    public static function createTransaction($uid, $coin, $txid, $from, $to, $amount, $confirm = 3, $time, $deposittype = null, $fees = 0, $network = "MAINNET")
    {
        $tran = CryptoTransactions::where(['uid' => $uid, 'currency' => $coin, 'txid' => $txid])->first();
        if($tran){
            return false;
        }
        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();
        try {
            $tran = new CryptoTransactions();
            $tran->uid = $uid;
            $tran->currency = $coin;
            $tran->txtype = 'deposit';
            $tran->txid = $txid;
            $tran->from_addr = $from;
            $tran->to_addr = $to;
            $tran->amount = $amount;
            $tran->totalamount = $amount;
            $tran->status = 1;
            $tran->nirvaki_nilai = 0;
            $tran->netfee = $fees;
            $tran->network = $network;
            $tran->created_at = $time;
            self::creditAmount_balance($uid, $coin, $amount, 8, $tran->id);
            if ($deposittype == 'token') {
                $tran->feestatus = 0;
            }
            $tran->confirmation = $confirm;
            $tran->save();
            $user = User::find($uid);
            if ($user) {
                $details = array(
                    'status'    => "Accept",
                    'coin'      => $coin,
                    'amount'    => $amount,
                    'user'      => $user->name
                );
                Mail::to($user->email)->send(new DepositEmail($details));
            }
            DB::connection('mysql')->commit();
            DB::connection('mysql2')->commit();
            return $tran;
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollback();
            DB::connection('mysql2')->rollback();
            return false;
        }
    }
    public static function histroy($type)
    {
        $histroy = CryptoTransactions::on('mysql2')->where(['currency' => $type, 'txtype' => 'withdraw'])->orderBy('id', 'desc')->paginate(15);

        return $histroy;
    }
    public static function edit($id)
    {
        $histroy = CryptoTransactions::on('mysql2')->where('id', $id)->first();
        return $histroy;
    }
    public static function withdrawUpdate($request)
    {

        $id         = $request->id;
        $status     = $request->status;
        $currency   = $request->currency;
        $txid   = $request->txid;

        $deposit_data = CryptoTransactions::on('mysql2')->where(['id' => $request->id, 'status' => 0])->first();

        if ($deposit_data) {
            $coin       = $deposit_data->coin_name;
            $amount     = $deposit_data->amount;
            $admin_fee  = $deposit_data->admin_fee;
            $uid        = $deposit_data->uid;

            if ($status == 2) {
                $wallet = UserWallet::on('mysql2')->where(['uid' => $deposit_data->uid, 'currency' => $currency])->first();


                //dd($wallet);
                if ($wallet) {
                    $return_amt         = $amount;
                    $wallet->balance      = ncAdd($wallet->balance, $return_amt);
                    $wallet->site_balance = ncAdd($wallet->site_balance, $return_amt);
                    $wallet->save();
                }

                $status1 = 'Cancel';
            } else {
                $status1 = 'Accept';
            }

            $deposit_data->status = $status;
            $deposit_data->txid = $txid;
            $deposit_data->save();
        }

        $user = User::on('mysql2')->where('id', $deposit_data->uid)->first();

        $details = array(
            'status'    => $status1,
            'coin'      => $coin,
            'amount'    => $deposit_data->amount,
            'user'      => $user->name
        );

        \Mail::to($user->email)->send(new WithdrawEmail($details));

        return true;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }



    public static function creditAmount_balance($uid, $currency, $amount, $decimal, $insertid)
    {
        $userbalance = UserWallet::where([['uid', '=', $uid], ['currency', '=', $currency]])
            ->lockForUpdate()
            ->first();
        if ($userbalance) {
            $oldbalance = $userbalance->balance;
            $walletbalance = ncAdd($amount, $userbalance->balance, $decimal);
            $site_balance = ncAdd($amount, $userbalance->site_balance, $decimal);
            $userbalance->balance = $walletbalance;
            $userbalance->site_balance = $site_balance;
            $userbalance->updated_at = date('Y-m-d H:i:s', time());
            $userbalance->save();

            self::AllcoinUpdateBalanceTrack($uid, $currency, $amount, $walletbalance, $oldbalance, $insertid);

            return $userbalance;
        } else {
            $oldbalance = 0;
            $walletbalance = $amount;
            UserWallet::insert(['uid' => $uid, 'currency' => $currency, 'balance' => $amount, 'site_balance' => $amount, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);

            self::AllcoinUpdateBalanceTrack($uid, $currency, $amount, $walletbalance, $oldbalance, $insertid);
            return true;
        }
    }

    public static function AllcoinUpdateBalanceTrack($uid, $currency, $amount, $walletbalance, $oldbalance, $insertid)
    {
        $coin = Commission::where("source",$currency)->first();
        if($coin->type == "coin"){
            $Models = '\App\Models\UserTransaction' . $currency;
            $remark = $currency . ' Deposit';
            $Models::AddTransaction($uid, 'deposit', $amount, 0, $walletbalance, $oldbalance, $remark, 'Admin', $insertid);
        } else {
            $Models = '\App\Models\UserTransactionToken';
            $remark = $currency . ' Deposit';
            $Models::AddTransaction($uid, 'deposit', $amount, 0, $walletbalance, $oldbalance, $remark, 'Admin', $insertid,$currency,$coin->network);
        }
        return true;
    }
}
