<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Models\UserWallet;
use App\Models\UserBchAddress;
use Illuminate\Support\Facades\DB;
use App\Models\CoinAddress;
use App\Models\Commission;

trait BchClass
{
   public function create_user_bch($uid) {
      $symbol = "BCH";
      $network = "MAINNET";
    $address = UserBchAddress::where('user_id',$uid)->value("address");
      DB::connection('mysql')->beginTransaction();
      DB::connection('mysql2')->beginTransaction();
      try {
        if(empty($address)){
          $bch = json_decode(shell_exec('node '.base_path().'/block_bch/generate_bch.js'));
          $address    = substr($bch->CashAddress,12);
          $cashaddress    = $bch->CashAddress;
          $legacyaddress  = $bch->LegacyAddress;
          $privatekey = Crypt::encryptString($bch->mnemonic);
          $bchaddress = new UserBchAddress;
          $credential = $privatekey;
          $bchaddress->user_id    = $uid;
          $bchaddress->address    = $address;
          $bchaddress->cashaddress    = $cashaddress;
          $bchaddress->legacyaddress    = $legacyaddress;
          $bchaddress->narcanru   = $credential;
          $bchaddress->balance    = 0.00000000;
          $bchaddress->save();
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