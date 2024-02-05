<?php
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserWallet;
use App\Models\UserLtcAddress;
use App\Traits\Litecoin;
use Illuminate\Support\Facades\DB;
use App\Models\CoinAddress;
use App\Models\Commission;

trait LtcClass
{
    use Litecoin;

    public function create_user_ltc($uid) {
      $symbol = "LTC";
      $network = "MAINNET";
      $address = UserLtcAddress::where('user_id',$uid)->value("address");
      DB::connection('mysql')->beginTransaction();
      DB::connection('mysql2')->beginTransaction();
      try {
        if(empty($address)){
          $ltc = json_decode(shell_exec('node '.base_path().'/block_ltc/generate_ltc.js'));
          $address    = $ltc->address;
          $publickey  = Crypt::encryptString($ltc->publickey);
          $wif        = Crypt::encryptString($ltc->wif);
          $privatekey = Crypt::encryptString($ltc->privatekey);
          $ltcaddress = new UserLtcAddress;
          $credential = $publickey.','.$wif.','.$privatekey;
          $ltcaddress->user_id    = $uid;
          $ltcaddress->address    = $address;
          $ltcaddress->narcanru   = $credential;
          $ltcaddress->balance    = 0.00000000;
          $ltcaddress->save();
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


}