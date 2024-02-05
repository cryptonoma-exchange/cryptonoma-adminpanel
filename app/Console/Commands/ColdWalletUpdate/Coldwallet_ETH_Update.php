<?php

namespace App\Console\Commands\ColdWalletUpdate;

use App\Models\Coldwalletaddress;
use App\Models\CryptoTransactions;
use App\Models\UserEthAddress;
use App\Traits\Ethereum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Coldwallet_ETH_Update extends Command
{

    use Ethereum;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:eth_cold_wallet';

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
        $transactions = CryptoTransactions::select([
            'to_addr',
            DB::raw('SUM(amount) as amt'),
            DB::raw("GROUP_CONCAT(id) AS ids"),
            DB::raw("GROUP_CONCAT(uid) AS uids")
        ])
        ->where([
            ["from_addr","!=","admindeposit"],
            ["txtype","=","deposit"],
            ['nirvaki_nilai','=',0],
            ['network',"=",$network],
            ["currency","=",$symbol]
        ])
        ->groupBy('to_addr')
        ->get();
        foreach ($transactions as $transaction) {
            $gasPrice = $this->getLivePrice();
            $fee =  ncMul(21000,$gasPrice);
            $fee = $this->weitoeth($fee);
            $ids = explode(',',$transaction->ids);
            $uids = explode(',',$transaction->uids);
            $uid    = $uids[0];
            $amount = $transaction->amt;
            $total = ncSub($amount,$fee,8);
            if($total > 0){
                $send = $this->createUserEthTransaction($uid,$total,$gasPrice);
                if($send){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
            sleep(1);
        }
    }

    function createUserEthTransaction($uid,$amt,$fee){
        try {
            $cold_wallet_address = Coldwalletaddress::first();
            $toaddress = $cold_wallet_address->eth_address;
            $userdetails = UserEthAddress::where(['user_id'=> $uid])->first();
            if($toaddress && $userdetails){
                $fromaddress = $userdetails->address;
                $credential = explode(',',$userdetails->narcanru);
                $pvtkey = Crypt::decrypt($credential[1]);
                $send = $this->ethSendTransaction($fromaddress,$toaddress,$amt,$pvtkey,$fee);
                if($send->txid != ''){
                    return true;
                } else{
                    return false;
                }
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
