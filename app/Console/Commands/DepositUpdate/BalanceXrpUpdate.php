<?php

namespace App\Console\Commands\DepositUpdate;

use App\Models\UserXrpAddress;
use Illuminate\Console\Command;
use App\Models\UserWallet;
use App\Models\CryptoTransactions;
use Carbon\Carbon;

class BalanceXrpUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit_update:xrp';

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
        $symbol = "XRP";
        $network = "MAINNET";
        $addresses = UserXrpAddress::get();
        foreach ($addresses as $address) {
            $uid = $address->user_id;
            $useraddress = $address->address;
            $payment_tag = $address->xrp_tag;
            if ($useraddress) {
                $url = 'https://data.ripple.com/v2/accounts/' . $useraddress . '/transactions?limit=1000&descending=true';
                $result = $this->curl($url);
                if (!empty($result)) {
                    if ($result['result'] == 'success' && $result['count'] > 0) {
                        foreach ($result['transactions'] as $trn) {
                            if (isset($trn['tx']['Amount'])) {
                                if (!is_array($trn['tx']['Amount'])) {
                                    if (isset($trn['tx']['DestinationTag'])) {
                                        $amount         = ncDiv($trn['tx']['Amount'], pow(10,6), 8);
                                        $time           = Carbon::parse($trn['date']);
                                        $receiver = $trn['tx']['Destination'];
                                        $type           = $trn['tx']['TransactionType'];
                                        $sender   = $trn['tx']['Account'];
                                        // $fee            = $trn['tx']['Fee'] / 1000000;
                                        $fees = 0;
                                        $confirm = 0;
                                        $txid           = $trn['hash'];
                                        $DestinationTag = $trn['tx']['DestinationTag'];
                                        if($DestinationTag){
                                            if (
                                                $type == "Payment" &&
                                                $payment_tag == $DestinationTag &&
                                                strtolower($useraddress) == strtolower($receiver) && 
                                                strtolower($sender) != strtolower($receiver)
                                            ) {
                                                CryptoTransactions::createTransaction($uid,$symbol,$txid,$sender,$receiver,$amount,$confirm,$time,null, $fees,$network);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
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
        if (empty($result)) {
            return false;
        }
        $isJson = isJson($result, true);
        if ($httpcode == 200 && $isJson->status) {
            return $isJson->data;
        }
        return false;
    }
}
