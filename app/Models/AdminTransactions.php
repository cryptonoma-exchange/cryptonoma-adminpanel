<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTransactions extends Model
{

	protected $connection = 'mysql2';
    protected $table ='bitcoinx_admin_transactions';
    public static function AdminWalletDetInsert($Updatedata)
    {
        $trans = new AdminTransactions();
        $trans->uid = $Updatedata['uid'];
        $trans->refid = $Updatedata['refid'];
        $trans->refentry = $Updatedata['refentry'];
        $trans->refentrysubtype = $Updatedata['refentrysubtype'];
        $trans->currency = $Updatedata['currency'];
        $trans->volumein = $Updatedata['volumein'];
        $trans->volumeout = $Updatedata['volumeout'];
        $trans->balance = $Updatedata['balance'];
        if(isset($Updatedata['remarks']))
        $trans->remarks = $Updatedata['remarks'];
        $trans->save();
        unset($Updatedata);
        return true;
    } 


    public static function Createtransaction($uid,$type,$amount,$quantity,$value,$fee,$commission)
    {
          $transaction = new AdminTransactions;

          $transaction->uid = $uid;
          $transaction->type = $type;
          $transaction->price = $amount;
          $transaction->quantity = $quantity;
          $transaction->value = $value;
          $transaction->fee = $fee;
          $transaction->commission = $commission;
          $transaction->save();
          return $transaction;
     
    }

}
