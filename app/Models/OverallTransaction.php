<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallTransaction extends Model
{
    protected $table = 'overall_transactions';

    public static function AddTransaction($uid,$coin,$type=null,$credit=0,$debit=0,$balance=0,$oldbalance=0,$remark=null,$update_from="admin",$insertid){
		$trans = new OverallTransaction();
		$trans->uid = $uid;
		$trans->coin = $coin;
		$trans->type = $type;
		$trans->credit = $credit;
		$trans->debit = $debit;
		$trans->balance = $balance;
		$trans->oldbalance = $oldbalance;
		$trans->remark = $remark;
		$trans->updatefrom = $update_from;
		$trans->actionfrom = $insertid;
		$trans->created_at = date('Y-m-d H:i:s',time());
		$trans->updated_at = date('Y-m-d H:i:s',time());
		$trans->save();
		return true;
    }

		public static function createTransaction($uid,$coin,$type=null,$credit=0,$debit=0,$balance=0,$oldbalance=0,$remark=null,$insertid=null,$update_from="user"	){
			$trans = new OverallTransaction();
			$trans->uid = $uid;
			$trans->coin = $coin;
			$trans->type = $type;
			$trans->credit = $credit;
			$trans->debit = $debit;
			$trans->balance = $balance;
			$trans->oldbalance = $oldbalance;
			$trans->remark = $remark;
			$trans->updatefrom = $update_from;
			$trans->actionfrom = $insertid;
			$trans->actionid = $insertid;
			$trans->created_at = date('Y-m-d H:i:s',time());
			$trans->updated_at = date('Y-m-d H:i:s',time());
			$trans->save();
			return true;
			} 
}
