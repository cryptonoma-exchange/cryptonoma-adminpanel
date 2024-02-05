<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Models\UserWallet;
use App\Models\UserBnbAddress; 
use App\Traits\Bep;
use App\Models\AdminFeeWallet;
use App\Models\AdminAddress;
use App\Models\AdminWithdrawAddress;

trait BNBClass
{
    use Bep;
	public function bnbaddresscreate() {
        $ch = curl_init();
        //0xdAC17F958D2ee523a2206206994597C13D831ec7        
     curl_setopt($ch, CURLOPT_URL, 'https://api.blockcypher.com/v1/eth/main/addrs?token=');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
    
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return json_decode($result);
    } 
}