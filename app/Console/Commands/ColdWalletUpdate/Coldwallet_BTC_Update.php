<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\Coldwalletaddress;
use App\Models\UserBtcAddress;
use App\Traits\Bitcoin;
use Illuminate\Support\Facades\Crypt;

class Coldwallet_BTC_Update extends Command
{
    use Bitcoin;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:btc_cold_wallet';

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
            $ids = explode(',',$transaction->ids);
            $uids = explode(',',$transaction->uids);
            $uid    = $uids[0];
            $amount = $transaction->amt;
            $fee    = 0.0001;
            $total  = ncSub($amount,$fee,8);
            if($total > 0.00001){
                $send  = $this->createUserBtcTransaction($uid,$total,$fee);
                if($send){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
            sleep(1);
        }
    }

    function createUserBtcTransaction($uid,$amt,$fee){
        $cold_wallet_address = Coldwalletaddress::first();
        $toaddress = $cold_wallet_address->btc_address;
        $userdetails = UserBtcAddress::where(['user_id'=> $uid])->first();
        if($toaddress && $userdetails){
            $fromaddress = $userdetails->address;
            $credential = explode(',',$userdetails->narcanru);
            $pvtkey = Crypt::decrypt($credential[2]);
            $send = $this->sendBtc($toaddress, $amt, $fromaddress,$pvtkey, $fee);
            if(isset($send->tx->hash) && $send->tx->hash!=''){
                return true;
            } else{
                return false;
            }
        }
        return false;
    }
}
