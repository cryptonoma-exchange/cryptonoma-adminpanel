<?php

namespace App\Console\Commands\DepositUpdate;

use App\Models\UserEthAddress;
use Illuminate\Console\Command;
use App\Models\CryptoTransactions;

class BalanceEthUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:eth';

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
        $symbol = "ETH";
        $network = "MAINNET";
        $addresses = UserEthAddress::get();
        $apikey = config("services.ETHERSCAN_API_KEY");
        foreach ($addresses as $address) {
            $uid = $address->user_id;
            $useraddress = $address->address;
            if ($useraddress) {
                $url = "http://api.etherscan.io/api?module=account&action=txlist&address={$useraddress}&startblock=0&endblock=99999999&sort=asc&apikey={$apikey}";
                $balance = $this->crul($url);
                if (isset($balance['result'])) {
                    foreach ($balance['result'] as $data) {
                        // try {
                        //     $gasPrice = $data["gasPrice"];
                        //     $gasUsed = $data["gasUsed"];
                        //     $fees = display_format(self::weitoeth($gasPrice*$gasUsed),8,"");
                        // } catch (\Throwable $th) {
                        //     $fees = 0;
                        // }
                        $fees = 0;
                        $tx_hash = $data['hash'];
                        $confirmations  = $data['confirmations'];
                        if ($confirmations < 3) {
                            continue;
                        }
                        $sender = $data['from'];
                        $receiver = $data['to'];
                        $time = date('Y-m-d H:i:s', $data['timeStamp']);
                        $total = self::weitoeth($data['value']);
                        if (strtolower($receiver) == strtolower($useraddress)) {
                            CryptoTransactions::createTransaction($uid, $symbol, $tx_hash, $sender, $receiver, $total, $confirmations, $time, null, $fees,$network);
                        }
                    }
                }
            }
            sleep(1); // this should halt for 2 seconds for every loop
        }
    }

    public function crul($url, $postfilds = null)
    {
        $this->url = $url;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        if (!is_null($postfilds)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postfilds);
        }
        if (strpos($this->url, '?') !== false) {
            curl_setopt($this->ch, CURLOPT_POST, 1);
        }
        $headers = array('Content-Length: 0');
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        if (curl_errno($this->ch)) {
            $this->result = 'Error:' . curl_error($this->ch);
        } else {
            $this->result = curl_exec($this->ch);
        }
        curl_close($this->ch);
        return json_decode($this->result, true);
    }

    public function weitoeth($amount)
    {
        return $amount / 1000000000000000000;
    }
}
