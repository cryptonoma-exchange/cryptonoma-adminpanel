<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Commission;
use App\Models\User;

class UserWallet extends Model
{
    protected $table = 'bitcoinx_wallets';
    protected $connection = 'mysql2';
    protected $guarded = [];

    public static function WalletSave($GetDetail = null, $Updatedata)
    {
        $ActualValue = 0;
        if (is_object($GetDetail)) {
            if (isset($Updatedata['volumein'])) {
                if ($Updatedata['volumein'] > 0) {
                    $GetDetail->balance = ncAdd($GetDetail->balance, $Updatedata['volumein']);
                    $GetDetail->site_balance = ncAdd($GetDetail->site_balance, $Updatedata['volumein']);
                    $Updatedata['volumeout'] = 0;
                    $ActualValue = $Updatedata['volumein'];
                }
            } else if (isset($Updatedata['volumeout'])) {
                if ($Updatedata['volumeout'] > 0) {
                    $GetDetail->balance = ncSub($GetDetail->balance, $Updatedata['volumeout']);
                    if ($GetDetail->balance < 0) {
                        throw new \Exception("Error Processing Request", 1);
                    }
                    $GetDetail->site_balance = ncSub($GetDetail->site_balance, $Updatedata['volumeout']);
                    $Updatedata['volumein'] = 0;
                    $ActualValue = $Updatedata['volumeout'];
                }
            }
            if (!isset($Updatedata['volumein']))
                $Updatedata['volumein'] = 0;
            if (!isset($Updatedata['volumeout']))
                $Updatedata['volumeout'] = 0;

            if ($Updatedata['volumeout'] > 0 || $Updatedata['volumein'] > 0)
                $GetDetail->save();
            $Updatedata['uid'] = $GetDetail->uid;
            $Updatedata['balance'] = $GetDetail->balance;
        } elseif (isset($Updatedata['volumein'])) {
            $GetDetail = new UserWallet();
            $Updatedata['volumeout'] = 0;
            $Updatedata['balance'] = $Updatedata['volumein'];
            $GetDetail->balance = $Updatedata['volumein'];
            $GetDetail->site_balance = $Updatedata['volumein'];
            $GetDetail->uid = $Updatedata['uid'];
            $GetDetail->created_at = date('Y-m-d H:i:s', time());
            $GetDetail->updated_at = date('Y-m-d H:i:s', time());
            $GetDetail->currency = $Updatedata['currency'];
            $ActualValue = $Updatedata['volumein'];
            if (!isset($Updatedata['volumein']))
                $Updatedata['volumein'] = 0;
            if (!isset($Updatedata['volumeout']))
                $Updatedata['volumeout'] = 0;
            if ($Updatedata['volumeout'] > 0 || $Updatedata['volumein'] > 0)
                $GetDetail->save();
        } else {
            throw new \Exception("Error Processing Request", 1);
        }
        $Updatedata['actualvalue'] = ncSub($ActualValue, $Updatedata['fee']);
        if ($Updatedata['volumeout'] > 0 || $Updatedata['volumein'] > 0)
            UserWalletDet::WalletDetInsert($Updatedata);
        unset($Updatedata);
        return true;
    }

    public static function WalletbalanceUpdate($Updatedata)
    {
        $oWalletDet = UserWallet::where([['uid', '=', $Updatedata['uid']], ['currency', $Updatedata['currency']]])->lockForUpdate()
            ->first();
        if (isset($Updatedata['volumeout'])) {
            if (!empty($oWalletDet)) {
                if ($Updatedata['volumeout'] > 0) {
                    if ($oWalletDet->balance < $Updatedata['volumeout']) {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        UserWallet::WalletSave($oWalletDet, $Updatedata);
        return true;
    }

    public static function WalletEcrowSave($GetDetail = null, $Updatedata)
    {
        if (!isset($Updatedata['isescrowin'])) {
            $Updatedata['isescrowin'] == false;
        }
        $ActualValue = 0;
        if (is_object($GetDetail)) {
            if (isset($Updatedata['volumein'])) {
                if ($Updatedata['volumein'] > 0) {
                    $GetDetail->balance = ncAdd($GetDetail->balance, $Updatedata['volumein'], $Updatedata['decimal']);
                    if (isset($Updatedata['istradecancel'])) {
                        $GetDetail->escrow_balance = ncSub($GetDetail->escrow_balance, $Updatedata['volumein'], $Updatedata['decimal']);
                    } else {
                        $GetDetail->site_balance = ncAdd($GetDetail->site_balance, $Updatedata['volumein'], $Updatedata['decimal']);
                    }
                    $Updatedata['volumeout'] = 0;
                    $ActualValue = $Updatedata['volumein'];
                }
            } elseif (isset($Updatedata['volumeout'])) {
                if ($Updatedata['volumeout'] > 0) {
                    if ($Updatedata['isescrowin'] == true) {
                        $GetDetail->balance = ncSub($GetDetail->balance, $Updatedata['volumeout'], $Updatedata['decimal']);
                        $GetDetail->escrow_balance = ncAdd($GetDetail->escrow_balance, $Updatedata['volumeout'], $Updatedata['decimal']);
                    } else {
                        $GetDetail->escrow_balance = ncSub($GetDetail->escrow_balance, $Updatedata['volumeout'], $Updatedata['decimal']);
                        $GetDetail->site_balance = ncSub($GetDetail->site_balance, $Updatedata['volumeout'], $Updatedata['decimal']);
                    }

                    $Updatedata['volumein'] = 0;
                    $ActualValue = $Updatedata['volumeout'];
                }
            }
            $GetDetail->save();
            $Updatedata['uid'] = $GetDetail->uid;
            $Updatedata['balance'] = $GetDetail->balance;
        } else {
            $GetDetail = new UserWallet();
            $Updatedata['volumeout'] = 0;
            $Updatedata['balance'] = $Updatedata['volumein'];
            $GetDetail->balance = $Updatedata['volumein'];
            $GetDetail->site_balance = $Updatedata['volumein'];
            $GetDetail->uid = $Updatedata['uid'];
            $GetDetail->created_at = date('Y-m-d H:i:s', time());
            $GetDetail->updated_at = date('Y-m-d H:i:s', time());
            $GetDetail->currency = $Updatedata['currency'];
            $ActualValue = $Updatedata['volumein'];
            $GetDetail->save();
        }
        $Updatedata['actualvalue'] = ncSub($ActualValue, $Updatedata['fee'], $Updatedata['decimal']);

        if (!($Updatedata['isescrowin'] == false &&  $Updatedata['volumeout'] > 0)) {
            UserWalletDet::WalletDetInsert($Updatedata);
        }
        unset($Updatedata);
        return true;
    }


    public static function WalletEscrowbalanceUpdate($Updatedata)
    {
        if (!isset($Updatedata['isescrowin'])) {
            $Updatedata['isescrowin'] = false;
        }
        $oWalletDet = UserWallet::where([['uid', '=', $Updatedata['uid']], ['currency', $Updatedata['currency']]])->lockForUpdate()
            ->first();
        if (isset($Updatedata['volumeout'])) {
            if (!empty($oWalletDet)) {
                if ($Updatedata['volumeout'] > 0) {
                    if ($Updatedata['isescrowin'] == true) {
                        if (($oWalletDet->balance < $Updatedata['volumeout'])) {
                            return false;
                        }
                    } else {
                        if ($oWalletDet->escrow_balance < $Updatedata['volumeout']) {
                            return false;
                        }
                    }
                }
            } else {
                return false;
            }
        }
        UserWallet::WalletEcrowSave($oWalletDet, $Updatedata);
        return true;
    }

    public static function userWalletDetails($id)
    {
        $wallets = UserWallet::on('mysql2')->where('uid', $id)->get();
        $coins = Commission::index();
        if (count($wallets) > 0) {
            foreach ($wallets as $balance) {
                $currency[$balance->currency]['balance'] = sprintf("%.8f", $balance->balance);
                $currency[$balance->currency]['escrow'] = sprintf("%.8f", $balance->escrow_balance);
                $currency[$balance->currency]['address'] = $balance->mukavari;
            }
            $currency = $currency;
        } else {
            $currency = "";
        }
        $details = array(
            'coin'         => $coins,
            'balance'     => $currency,
        );
        return $details;
    }

    public static function balanceupdate($request, $uid)
    {
        $exits =  User::on('mysql2')->where('id', $uid)->count();

        if ($exits > 0) {
            $lists = Commission::get();
            $balance = 0;
            if (count($lists) > 0) {
                foreach ($lists as $list) {
                    $coin           = $list->source;
                    $requestcoin    = 'balance_' . $coin;
                    $balance        = $request->$requestcoin;
                    if (!isset($balance)) {
                        $balance = 0;
                    }
                    $wallet = UserWallet::on('mysql2')->where(['uid' => $uid, 'currency' => $coin])->first();
                    if ($wallet) {
                        $wallet->balance = $balance;
                        $wallet->updated_at = date('Y-m-d H:i:s', time());
                    } else {
                        $wallet = new UserWallet;
                        $wallet->setConnection('mysql2');
                        $wallet->uid            = $uid;
                        $wallet->currency       = $coin;
                        $wallet->balance        = $balance;
                        $wallet->site_balance   = $balance;
                        $wallet->created_at     = date('Y-m-d H:i:s', time());
                        $wallet->updated_at     = date('Y-m-d H:i:s', time());
                    }
                    $wallet->save();
                }
            }
        }

        return true;
    }

    public static function creditAmount($uid, $currency, $amount, $decimal)
    {
        $userbalance = UserWallet::where([['uid', '=', $uid], ['currency', '=', $currency]])->first();

        if ($userbalance) {
            $total = ncAdd($amount, $userbalance->balance, $decimal);
            $site_balance = ncAdd($amount, $userbalance->site_balance, $decimal);
            $userbalance->balance = $total;
            $userbalance->site_balance = $site_balance;
            $userbalance->updated_at = date('Y-m-d H:i:s', time());
            $userbalance->save();
            return $userbalance;
        } else {
            UserWallet::insert(['uid' => $uid, 'currency' => $currency, 'balance' => $amount, 'site_balance' => $amount, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        }
    }
}
