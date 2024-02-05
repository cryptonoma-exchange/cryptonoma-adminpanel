<?php

namespace App\Console\Commands\DepositUpdate;

use Illuminate\Console\Command;
use App\Models\UserBnbAddress;
use App\Models\CryptoTransactions;

class BalanceBnbUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:bnb';

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
        $symbol = "BNB";
        $network = "MAINNET";
        $addresses = UserBnbAddress::get();
        foreach ($addresses as $address) {
            $uid = $address->user_id;
            $useraddress = $address->address;
            if ($useraddress) {
                $response = $this->getBnbNewTransactions($useraddress);;
                $count = count($response['result']);
                if ($count > 0) {
                    $result_data = $response['result'];
                    foreach ($result_data as $data) {
                        $fees = 0;
                        // try {
                        //     $gasPrice = $data["gasPrice"];
                        //     $gasUsed = $data["gasUsed"];
                        //     $fees = display_format(self::weitoeth($gasPrice*$gasUsed),8,"");
                        // } catch (\Throwable $th) {
                        //     $fees = 0;
                        // }
                        $txid     = $data['hash'];
                        $confirm  = $data['confirmations'];
                        $sender     = $data['from'];
                        $receiver       = $data['to'];
                        $time     = date('Y-m-d H:i:s', $data['timeStamp']);
                        $total    = self::weitoeth($data['value']);
                        $amount   = display_format($total,8,"");
                        if (strtolower($receiver) == strtolower($useraddress)) {
                            CryptoTransactions::createTransaction($uid,$symbol,$txid,$sender,$receiver,$amount,$confirm,$time,null, $fees,$network);
                        }
                    }
                }
            }
        }
    }

    public function getBnbNewTransactions($useraddress)
    {
        $apikey = config("services.BSCSCAN_API_KEY");
        $url = "http://api.bscscan.com/api?module=account&action=txlist&address=" . $useraddress . "&startblock=0&endblock=99999999&sort=asc&apikey=".$apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "Accept: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if (curl_errno($ch)) {
            $result = "";
        } else {
            $result = curl_exec($ch);
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (empty($result)) {
            return false;
        }
        $isJson = isJson($result,true);
        if ($httpcode == 200 && $isJson->status) {
            return $isJson->data;
        }
        return false;
    }

    public function wei($amount)
    {
        return number_format((1000000000000000000 * $amount), 0, '.', '');
    }

    public function weitoeth($amount)
    {
        return $amount / 1000000000000000000;
    }
}
