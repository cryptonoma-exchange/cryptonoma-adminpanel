<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Models\Commission;
use App\Models\User;


  
class UserWalletDet extends Model
{
    protected $table = 'bitcoinx_walletdetail';
    protected $connection = 'mysql2';

    public static function WalletDetInsert($Updatedata)
    {
        $trans = new UserWalletDet();
        $trans->uid = $Updatedata['uid'];
        $trans->refid = $Updatedata['refid'];
        $trans->refentry = $Updatedata['refentry'];
        $trans->refentrysubtype = $Updatedata['refentrysubtype'];
        $trans->currency = $Updatedata['currency'];
        if (isset($Updatedata['currencytype']))
            $trans->currencytype = $Updatedata['currencytype'];
        $trans->volumein = $Updatedata['volumein'];
        $trans->volumeout = $Updatedata['volumeout'];
        $trans->balance = $Updatedata['balance'];
        $trans->actualvalue = $Updatedata['actualvalue'];
        $trans->fee = $Updatedata['fee'];
        $trans->remarks = $Updatedata['remarks'];
        $trans->created_at = date('Y-m-d H:i:s', time());
        $trans->docdate_at = date('Y-m-d H:i:s', time());
        $trans->updated_at = date('Y-m-d H:i:s', time());
        $trans->save();
        unset($Updatedata);
        return true;
    }
}

