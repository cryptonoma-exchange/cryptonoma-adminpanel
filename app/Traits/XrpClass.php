<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;
use App\Models\UserWallet;
use App\Models\UserXrpAddress;
use App\Models\AdminFeeWallet;
use Illuminate\Support\Facades\DB;
use App\Models\CoinAddress;
use App\Models\Commission;

trait XrpClass
{
    public function create_user_xrp($uid)
    {
        $symbol = "XRP";
        $network = "MAINNET";
        $admin_xrpaddress = AdminFeeWallet::where('coinname', 'XRP')->value("address");
        $useraddress = $admin_xrpaddress;
        $xrpaddress = UserXrpAddress::where('user_id', $uid)->first();
        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();
        try {
            if (!$xrpaddress) {
                $number = $this->generateBarcodeNumber();
                $xrpaddress = new UserXrpAddress;
                $xrpaddress->user_id = $uid;
                $xrpaddress->address = $useraddress;
                $xrpaddress->narcanru = $number;
                $xrpaddress->xrp_tag = $number;
                $xrpaddress->balance = 0.00000000;
                $xrpaddress->save();
            }
            $number = $xrpaddress->narcanru;
            if (!empty($useraddress) && !empty($number)) {
                $coin = Commission::where("source",$symbol)->first();
                $walletaddress = CoinAddress::where(['user_id' => $uid, 'coin_id' => $coin->id, "network" => $network])->lockForUpdate()->first();
                if (!$walletaddress) {
                    $walletaddress = new CoinAddress;
                    $walletaddress->user_id = $uid;
                    $walletaddress->coin_id = $coin->id;
                    $walletaddress->payment_id = $number;
                    $walletaddress->address = $useraddress;
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
        return $useraddress;
    }

    public function barcodeNumberExists($number)
    {
        return UserXrpAddress::where('narcanru', $number)->exists();
    }
    public function generateBarcodeNumber()
    {
        $number = mt_rand(100000, 999999); // better than rand()
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }
        // otherwise, it's valid and can be used
        return $number;
    }

    public function xrp_admin_address_create()
    {
        $xrpaddress = AdminFeeWallet::where('coinname', 'XRP')->first();
        if (!$xrpaddress) {
            $data = json_decode(shell_exec('node ' . base_path() . '/block_xrp/xrp_address_generate.js'));
            $address = $data->address;
            $xAddress = $data->xAddress;
            $classicAddress = $data->classicAddress;
            $privateKey = $data->secret;
            $credential = [Crypt::encrypt($privateKey), Crypt::encrypt($xAddress), Crypt::encrypt($classicAddress)];
            $xrpaddress = new AdminFeeWallet;
            $xrpaddress->coinname = "XRP";
            $xrpaddress->address = $address;
            $xrpaddress->narcanru = implode(",", $credential);
            $xrpaddress->fee = 0.0005;
            $xrpaddress->balance = 0.00000000;
            $xrpaddress->save();
        }
        return $xrpaddress;
    }

    function cUrl_xrp($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $result = 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
    }

    function xrpbalanceupdate($address)
    {
        $url = 'https://data.ripple.com/v2/accounts/' . $address . '/balances?currency=XRP';
        $data = self::cUrl_xrp($url);
        $balance = 0;
        if ($data['result'] == 'success') {
            $balance = $data['balances'][0]['value'];
        }
        return $balance;
    }
}
