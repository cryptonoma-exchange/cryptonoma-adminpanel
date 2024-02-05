<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Models\Coinuser;
use App\Models\UserWallet;
use App\Models\UserEthAddress;
use App\Models\UserErc20Address;
use App\Libraries\BitGo;
use Config;
use App\Models\User;
trait EthClass
{   

    public function ethcreate() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.blockcypher.com/v1/eth/main/addrs?token=c1dd7a1ee43c40e08d76e43870ee919e');
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

    public function create_user_eth($id)
    {

        $address = UserEthAddress::where('user_id',$id)->value('address');
        if(!$address){
            $coin = 'eth';
            $token = 'v2x1fc26230bf9173186f524cfc91e4e6c9b12f1d3141482515cd367567e75f840b';
            $walletid = '5ea6b93f45444e2d07adcd21bde1a457';
            $label = User::where('id',$id)->value('referral_id');
            $bitgo = new BitGo();
            $generate = $bitgo->GenerateAddress($coin,$token,$walletid,$label);  
           //dd($generate);    
            $eth = $bitgo->GetWalletDetails($coin,$token,$walletid,$generate->id);
            if(isset($eth->address)){
                $address = $eth->address;
            }else{
               $address = ''; 
            }      
            
            $ethtable = new UserEthAddress;
            $ethtable->user_id = $id;
            $ethtable->address = $address;
            $ethtable->narcanru = $generate->id;
            $ethtable->balance = 0.00000000;
            $ethtable->save();
        }

        $walletaddress = UserWallet::on('mysql2')->where(['uid'=> $id,'currency' => 'ETH'])->first();
		
        $balance = 0;
        if(!$walletaddress){  
            $walletaddress = new UserWallet; 
            $walletaddress->setConnection('mysql2');
            $walletaddress->uid = $id;
            $walletaddress->currency = 'ETH';
        }

        $walletaddress->mukavari            = $address; 
        $walletaddress->balance             = $walletaddress->balance + $balance ; 
        $walletaddress->site_balance        = $walletaddress->balance + $balance ; 
        $walletaddress->created_at          = date('Y-m-d H:i:s',time()); 
        $walletaddress->updated_at          = date('Y-m-d H:i:s',time()); 
        $walletaddress->save();        
        return $address;
            
    }
	
    private function convert_six_digits($amount){
        if(!empty($amount)){
            return 1000000 * $amount;
        }
    }
    private function convert_eight_digits($amount){
        if(!empty($amount)){
            return 100000000 * $amount;
        }
    }
}

?>