<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminwallet extends Model
{
    protected $table = 'bitcoinx_adminwallet';
    protected $connection = 'mysql2';

    public static function admincreditAmount($currency, $amount, $commission,$type = NULL)
    {
        $adminbalnce = Adminwallet::where([['currency', '=',$currency]])->first();
        if($adminbalnce) {
            $total = ncAdd($amount, $adminbalnce->balance, 8);
            $commission1 = ncAdd($commission, $adminbalnce->commission, 8);
            $adminbalnce->balance = $total;
            $adminbalnce->commission = $commission1;
            $adminbalnce->instant_type = $type;
            $adminbalnce->updated_at = date('Y-m-d H:i:s',time());
            $adminbalnce->save();
            return $adminbalnce;
        } else {        	
            Adminwallet::insert(['currency' => $currency, 'balance' => $amount, 'commission' => $commission, 'instant_type' => $type, 'created_at' => date('Y-m-d H:i:s',time()), 'updated_at' => date('Y-m-d H:i:s',time())]);
        }
    }

    public static function AdminWalletSave($GetDetail = null, $Updatedata)
    {
        $ActualValue = 0;
        if (!empty($GetDetail)) {
            if (isset($Updatedata['volumein'])) {
                if ($Updatedata['volumein'] > 0) {
                    $GetDetail->balance = ncAdd($GetDetail->balance, $Updatedata['volumein']);
                    $Updatedata['volumeout'] = 0;
                    $ActualValue = $Updatedata['volumein'];
                }
            } else if (isset($Updatedata['volumeout'])) {           
                if ($Updatedata['volumeout'] > 0) {
                    $GetDetail->balance = ncSub($GetDetail->balance, $Updatedata['volumeout']);
                     $Updatedata['volumein'] = 0;
                    $ActualValue = $Updatedata['volumeout'];
                }
            }
            $GetDetail->save();      
            $Updatedata['balance'] = $GetDetail->balance;
        } else {
            $GetDetail=new Adminwallet();
            $Updatedata['volumeout']=0;
            $Updatedata['balance']=$Updatedata['volumein'];
            $GetDetail->balance = $Updatedata['volumein'];     
            $GetDetail->currency = $Updatedata['currency'];
            $ActualValue = $Updatedata['volumein'];
            $GetDetail->save();
        }
        AdminTransactions::AdminWalletDetInsert($Updatedata);
        unset($Updatedata);
        return true;
    }

    public static function AdminWalletbalanceUpdate($Updatedata)
    {      
        $oWalletDet = Adminwallet::where([['currency', $Updatedata['currency']]])->lockForUpdate()
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
        return Adminwallet::AdminWalletSave($oWalletDet, $Updatedata); 
    }



}
