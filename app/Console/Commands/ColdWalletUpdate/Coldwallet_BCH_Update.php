<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\UserBchAddress;
use Illuminate\Support\Facades\Crypt;
use App\Models\Coldwalletaddress;
use App\Traits\BitcoinCash;
use Illuminate\Support\Facades\Log;

class Coldwallet_BCH_Update extends Command
{

    use BitcoinCash;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bch_cold_wallet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $symbol = "BCH";
        $network = "MAINNET";
        $transactions = CryptoTransactions::select([
            'to_addr',
            DB::raw('SUM(amount) as amt'),
            DB::raw("GROUP_CONCAT(id) AS ids"),
            DB::raw("GROUP_CONCAT(uid) AS uids")
        ])
            ->where([
                ["from_addr", "!=", "admindeposit"],
                ["txtype", "=", "deposit"],
                ['nirvaki_nilai', '=', 0],
                ['network',"=",$network],
                ["currency", "=", $symbol]
            ])
            ->groupBy('to_addr')
            ->get();
        foreach ($transactions as $transaction) {
            $ids = explode(',', $transaction->ids);
            $uids = explode(',', $transaction->uids);
            $uid    = $uids[0];
            $amount = $transaction->amt;
            $fee    = 0.0001;
            $total  = ncSub($amount, $fee, 8);
            if($total > 0.00001){
                $send   = $this->createUserBCHTransaction($uid,$total);
                if($send->txId){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
        }
    }

    function createUserBCHTransaction($uid, $amt)
    {
        $cold_wallet_address = Coldwalletaddress::first();
        $toaddress = $cold_wallet_address->bch_address;
        $userdetails = UserBchAddress::where(['user_id' => $uid])->first();
        if ($toaddress) {
            $fromaddress = $userdetails->address;
            $credential = $userdetails->narcanru;
            $pvtkey = Crypt::decryptString($credential);
            $ogetprivate = ($this->Getbchprivatekey($pvtkey));
            $pvtkey = ($ogetprivate->privatekey);
            $utxos = json_decode($this->bch_utxo($userdetails->cashaddress), true);
            if (!empty($utxos)) {
                foreach ($utxos as $key => $values) {
                    $txhash = $key;
                    $index = $values;
                }
                $fromdetails = array(
                    "txhash" =>
                    $txhash, "index" => $index, "privateKey" => $pvtkey
                );
                $todetails = array(
                    "address" =>
                    $toaddress, "value" => $amt
                );
                $params = array(
                    "fromUTXO" => $fromdetails,
                    "to" => $todetails
                );
                return $this->sendtatumbch($params);
            }
        }
        return true;
    }



    private function sendtatumbch($params, $postfilds = null)
    {
        if (!empty($params)) {
            $txhash = $params['fromUTXO']['txhash'];
            $index = $params['fromUTXO']['index'];
            $privatekey = $params['fromUTXO']['privateKey'];
            $toaddress = $params['to']['address'];
            $value = $params['to']['value'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api-us-west1.tatum.io/v3/bcash/transaction");
            $params = json_encode($params);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"fromUTXO\":[{\"txHash\":\"$txhash\",\"index\":$index,\"privateKey\":\"$privatekey\"}],\"to\":[{\"address\":\"$toaddress\",\"value\":$value}]}");

            curl_setopt($ch, CURLOPT_POST, 1);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = "x-api-key:";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);
            Log::channel("cold_wallet_move")->info(json_encode([
                'from_address' => $txhash,
                'to_address' => $toaddress,
                'amount' => $value,
                "coin" => "BCH"
            ]));
            Log::channel("cold_wallet_move")->info($result);
            return json_decode($result);
        } else {
            return false;
        }
    }
}
