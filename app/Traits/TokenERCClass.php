<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Models\UserWallet;
use App\Models\TokenAddress;
use App\Models\UserEthAddress;
use App\Models\Commission;
use App\Models\AdminFeeWallet;
use App\Models\UserBnbAddress;
use Illuminate\Support\Facades\DB;
use App\Models\CoinAddress;
use App\Models\TokenMultinetwork;

trait TokenERCClass
{
    public function erctokencreate()
    {
        $ch = curl_init();
        $token = config("services.BLOCKCYPHER_TOKEN");
        curl_setopt($ch, CURLOPT_URL, 'https://api.blockcypher.com/v1/eth/main/addrs?token='.$token);
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
        curl_close($ch);
        return json_decode($result);
    }

    public function createETHAdminFeeWalletAddress(){
        $symbol = "ETH";
        $exists = AdminFeeWallet::where("coinname",$symbol)->first();
        if(!$exists){
            $erctoken = $this->erctokencreate();
            $address = "0x".$erctoken->address;
            $publickey = Crypt::encrypt($erctoken->private);
            $privatekey = Crypt::encrypt($erctoken->public);
            $wallet = new AdminFeeWallet();
            $wallet->coinname = $symbol;
            $wallet->address = $address;
            $wallet->narcanru = $privatekey.','.$publickey;
            $wallet->save();
        }
    }

    public function createBNBAdminFeeWalletAddress(){
        $symbol = "BNB";
        $exists = AdminFeeWallet::where("coinname",$symbol)->first();
        if(!$exists){
            $erctoken = $this->erctokencreate();
            $address = "0x".$erctoken->address;
            $publickey = Crypt::encrypt($erctoken->private);
            $privatekey = Crypt::encrypt($erctoken->public);
            $wallet = new AdminFeeWallet();
            $wallet->coinname = $symbol;
            $wallet->address = $address;
            $wallet->narcanru = $privatekey.','.$publickey;
            $wallet->save();
        }
    }

    public function createEthAddress($uid)
    {
        $symbol = "ETH";
        $network = "MAINNET";
        $address = UserEthAddress::where('user_id', $uid)->value('address');
        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();
        try {
            if (!$address) {
                $erctoken = $this->erctokencreate();
                $address = "0x".$erctoken->address;
                $publickey = Crypt::encrypt($erctoken->private);
                $privatekey = Crypt::encrypt($erctoken->public);
                $ethtable = new UserEthAddress;
                $ethtable->user_id = $uid;
                $ethtable->address = $address;
                $ethtable->narcanru = $privatekey.','.$publickey;
                $ethtable->balance = 0.00000000;
                $ethtable->save();
            }
            if (!empty($address)) {
                $coin = Commission::where("source",$symbol)->first();
                $walletaddress = CoinAddress::where(['user_id' => $uid, 'coin_id' => $coin->id, "network" => $network])->lockForUpdate()->first();
                if (!$walletaddress) {
                    $walletaddress = new CoinAddress;
                    $walletaddress->user_id = $uid;
                    $walletaddress->coin_id = $coin->id;
                    $walletaddress->address = $address;
                    $walletaddress->network = $network;
                    $walletaddress->save();
                }
            }
          DB::connection('mysql')->commit();
          DB::connection('mysql2')->commit();
        } catch (\Throwable $th) {
          DB::connection('mysql')->rollback();
          DB::connection('mysql2')->rollback();
        }
        return $address;
    }

    public function createBnbAddress($uid)
    {
        $symbol = "BNB";
        $network = "MAINNET";
        $address = UserBnbAddress::where('user_id', $uid)->value('address');
        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();
        try {
            if (!$address) {
                $erctoken = $this->erctokencreate();
                $address = "0x".$erctoken->address;
                $publickey = Crypt::encrypt($erctoken->private);
                $privatekey = Crypt::encrypt($erctoken->public);
                $ethtable = new UserBnbAddress;
                $ethtable->user_id = $uid;
                $ethtable->address = $address;
                $ethtable->narcanru = $privatekey.','.$publickey;
                $ethtable->balance = 0.00000000;
                $ethtable->save();
            }
            if (!empty($address)) {
                $coin = Commission::where("source",$symbol)->first();
                $walletaddress = CoinAddress::where(['user_id' => $uid, 'coin_id' => $coin->id, "network" => $network])->lockForUpdate()->first();
                if (!$walletaddress) {
                    $walletaddress = new CoinAddress;
                    $walletaddress->user_id = $uid;
                    $walletaddress->coin_id = $coin->id;
                    $walletaddress->address = $address;
                    $walletaddress->network = $network;
                    $walletaddress->save();
                }
            }
          DB::connection('mysql')->commit();
          DB::connection('mysql2')->commit();
        } catch (\Throwable $th) {
          DB::connection('mysql')->rollback();
          DB::connection('mysql2')->rollback();
        }
        return $address;
    }


    public function create_user_erctoken($uid)
    {
        $address = TokenAddress::where('user_id', $uid)->value('address');
        if (!$address) {
            $erctoken = $this->erctokencreate();
            $address = "0x".$erctoken->address;
            $pvtk = Crypt::encrypt($erctoken->private);
            $pubk = Crypt::encrypt($erctoken->public);

            $ethtable = new TokenAddress;
            $ethtable->user_id = $uid;
            $ethtable->address = $address;
            $ethtable->narcanru = $pvtk.','.$pubk;
            $ethtable->save();
        }
        $this->token_address_generate($uid, $address);
        return $address;
    }
    
    public function token_address_generate($uid, $address)
    {
        $tokens = TokenMultinetwork::withWhereHas('coin', function($query){
            return $query->where("type","token");
        })->get();
        foreach ($tokens as $token) {
            $coin = $token->coin;
            $symbol = $coin->source;
            $network = $token->network;
            if (!empty($address)) {
                $coin = Commission::where("source",$symbol)->first();
                $walletaddress = CoinAddress::where(['user_id' => $uid, 'coin_id' => $coin->id, "network" => $network])->lockForUpdate()->first();
                if (!$walletaddress) {
                    $walletaddress = new CoinAddress;
                    $walletaddress->user_id = $uid;
                    $walletaddress->coin_id = $coin->id;
                    $walletaddress->address = $address;
                    $walletaddress->network = $network;
                    $walletaddress->save();
                }
            }
        }
        return true;
    }
    public function createTransactionERCToken($uid, $source, $toaddress, $eth_amount)
    {
        $token = Commission::where('source', $source)->first();
        $toaddress = $toaddress;
        $private = TokenAddress::where([['user_id', '=',$uid]])->first();
        $fromaddress = $private->address;
        $credential = explode(',', $private->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $ch = curl_init();
        $params = array(
            "method"        => "create_rawtx_token",
            "formaddr"      => $fromaddress,
            "pvk"           => $pvk,
            "toddr"         => $toaddress,
            "amount"        => $this->convert_digits($eth_amount, $token->decimal),
            "contract"      => $token->contractaddress,
            "abiarray"      => $token->abiarray,
            "url"           => "https://mainnet.infura.io/v3/e60e25395854451e920f64128b239610"
        );
        $node = config("services.node.ETH");
        curl_setopt($ch, CURLOPT_URL, $node);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $headers = array();
        $headers[] = "Content-Type : application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result);
    }
    private function convert_digits($amount, $tokenDecimal=null)
    {
        if (!empty($amount)) {
            if ($tokenDecimal > 0) {
                $tokenDecimal = 1 + $tokenDecimal;
                $number = 1;
                $number = str_pad($number, $tokenDecimal, '0', STR_PAD_RIGHT);
            } else {
                $number = 1;
            }
            return $amount * $number;
        }
    }

    public function AdminfeeTransaction($toaddress, $amount)
    {
        $AdminFeeWallet = AdminFeeWallet::where('coinname', 'ETH')->first();
        $fromaddress = $AdminFeeWallet->address;
        $credential = explode(',', $AdminFeeWallet->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $ch = curl_init();
        $params = array(
            "method"        => "create_rawtx",
            "formaddr"      => $fromaddress,
            "pvk"           => $pvk,
            "toddr"         => $toaddress,
            "amount"        => $amount,
            "url"           => "https://mainnet.infura.io/v3/e60e25395854451e920f64128b239610"
        );
        curl_setopt($ch, CURLOPT_URL, "http://137.184.222.84:9545");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $headers = array();
        $headers[] = "Content-Type : application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result);
    }
}
