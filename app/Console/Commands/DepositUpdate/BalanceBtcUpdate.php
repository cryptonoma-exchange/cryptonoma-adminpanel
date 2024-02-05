<?php

namespace App\Console\Commands\DepositUpdate;

use App\Models\UserBtcAddress;
use Illuminate\Console\Command;
use App\Models\CryptoTransactions;

class BalanceBtcUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:btc';

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
        $symbol = "BTC";
        $network = "MAINNET";
        $addresses = UserBtcAddress::get();
        foreach ($addresses as $address) {
            $useraddress = $address->address;
            $uid = $address->user_id;
            if ($useraddress) {
                $get_Transaction = $this->getBtcTransactions($useraddress);
                if ($get_Transaction && isset($get_Transaction->data->list) && count($get_Transaction->data->list) > 0) {
                    foreach ($get_Transaction->data->list as $Transaction) {
                        $tx_hash = $Transaction->hash;
                        $confirmations = $Transaction->confirmations;
                        $fees = 0;
                        // $fees = ncDiv($Transaction->fee,pow(10,8));
                        $time = $Transaction->block_time;
                        $sender = $receiver = null;
                        if ($confirmations < 3) {
                            continue;
                        }

                        //get hash
                        $get_transaction_data = $this->executeBlockTransaction($tx_hash);
                        if (isset($get_transaction_data->inputs)) {
                            foreach ($get_transaction_data->inputs as $vin => $key_value) {
                                if (isset($get_transaction_data->inputs[$vin]->prev_out->addr)) {
                                    if ($useraddress == $get_transaction_data->inputs[$vin]->prev_out->addr) {
                                        break;
                                    } else {
                                        $sender = $get_transaction_data->inputs[$vin]->prev_out->addr;
                                    }
                                }
                            }
                            foreach ($get_transaction_data->out as $vout => $key_value_data) {
                                if (isset($get_transaction_data->out[$vout]->addr)) {
                                    if ($useraddress == $get_transaction_data->out[$vout]->addr) {
                                        $receiver = $get_transaction_data->out[$vout]->addr;
                                        $total = $get_transaction_data->out[$vout]->value / pow(10,8);
                                    }
                                }
                            }
                            if ($sender != $useraddress && $receiver == $useraddress) {
                                $type = "send";
                                if (isset($receiver) && $receiver == $useraddress) {
                                    $type = "received";
                                }
                                if (isset($receiver) && $type == 'received') {
                                    CryptoTransactions::createTransaction($uid, $symbol, $tx_hash, $sender, $receiver, $total, $confirmations, $time, null, $fees,$network);
                                }
                            }
                        }
                    }
                }
            }
            sleep(1); // this should halt for 2 seconds for every loop
        }
    }

    public function getBtcTransactions($address, $from = null, $to = null)
    {
        if (!empty($address)) {
            $url = "https://chain.api.btc.com/v3/address/" . $address . "/tx";
            return json_decode($this->crul($url));
        }
    }

    public function executeBlockTransaction($hash_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://blockchain.info/rawtx/" . $hash_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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

    public function crul($url)
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
            echo $result = 'Error:' . curl_error($ch);
        } else {
            $result = curl_exec($ch);
        }
        curl_close($ch);
        return $result;
    }
}
