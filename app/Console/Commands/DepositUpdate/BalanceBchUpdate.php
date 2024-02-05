<?php

namespace App\Console\Commands\DepositUpdate;

use Illuminate\Console\Command;
use App\Models\UserBchAddress;
use App\Models\CryptoTransactions;

class BalanceBchUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:bch';

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
        $addresses = UserBchAddress::get();
        foreach ($addresses as $address) {
            $uid = $address->user_id;
            $useraddress = $address->address;
            if ($useraddress) {
                $tran = $this->getBchNewTransactions($useraddress);
                if ($tran && !isset($tran->errorCode)) {
                    if (count($tran) > 0) {
                        foreach ($tran as $values) {
                            foreach ($values->vout as $vout) {
                                if (isset($vout->scriptPubKey->addresses)) {
                                    if (in_array($useraddress, $vout->scriptPubKey->addresses)) {
                                        $txid = $values->txid;
                                        $time     = date('Y-m-d H:i:s', $values->time);
                                        $confirm = $values->confirmations;
                                        $amount = $vout->value;
                                        $sender = '';
                                        $receiver = $vout->scriptPubKey->addresses[0];
                                        if($confirm < 3){
                                            continue;
                                        }
                                        CryptoTransactions::createTransaction($uid,$symbol,$txid,$sender,$receiver,$amount,$confirm,$time,null, 0,$network);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            sleep(2); // this should halt for 2 seconds for every loop
        }
    }

    public function getBchNewTransactions($useraddress)
    {
        $url = "https://api-eu1.tatum.io/v3/bcash/transaction/address/".$useraddress;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "Accept: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if (curl_errno($ch)) {
            // echo $result = 'Error:' . curl_error($ch);
            $result = "";
        } else {
            $result = curl_exec($ch);
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (empty($result)) {
            return false;
        }
        $isJson = isJson($result);
        if ($httpcode == 200 && $isJson->status) {
            return $isJson->data;
        }
        return false;
    }
}
