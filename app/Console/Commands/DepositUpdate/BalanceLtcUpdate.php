<?php

namespace App\Console\Commands\DepositUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Models\UserLtcAddress;

class BalanceLtcUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:ltc';

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
        $symbol = "LTC";
        $network = "MAINNET";
        $addresses = UserLtcAddress::get();
        foreach ($addresses as $address) {
            $uid = $address->user_id;
            $useraddress = $address->address;
            if($useraddress){
                $url = 'https://chain.so/api/v2/get_tx_unspent/LTC/' . $useraddress;
                $tran = $this->curl($url);
                if($tran === false){
                    continue;
                }
                if(count($tran->data->txs) > 0){
                    foreach ($tran->data->txs as $addr) {
                        $url = 'https://chain.so/api/v2/get_tx/LTC/'. $addr->txid;
                        $trans_details = $this->curl($url);
                        if($trans_details === false){
                            continue;
                        }
                        if($trans_details->status == 'success'){
                            $txid       = $trans_details->data->txid;
                            $receiver = '';
                            foreach($trans_details->data->outputs as $vout){
                                if(isset($vout->address) && $useraddress == $vout->address) {
                                    $receiver = $useraddress;
                                    $amount = $vout->value;
                                    break;
                                } 
                            }
                            $sender = $trans_details->data->inputs[0]->address;
                            $time       = $trans_details->data->time;
                            // $fees       = $trans_details->data->network_fee;
                            $fees = 0;
                            $confirm    = $trans_details->data->confirmations;
                            if($confirm < 3){
                                continue;
                            }
                            if ($receiver == $useraddress && isset($amount)) {
                                CryptoTransactions::createTransaction($uid,$symbol,$txid,$sender,$receiver,$amount,$confirm,$time,null, $fees,$network);
                            }
                        }
                    }
                }
            }
            sleep(1);
        }
    }

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "Accept: application/json, text/plain";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if (curl_errno($ch)) {
            $result = "";
        } else {
            $result = curl_exec($ch);
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if(empty($result)){
            return false;
        }
        $isJson = isJson($result);
        if($httpcode == 200 && $isJson->status){
            return $isJson->data;
        }
        return false;
    }
}
