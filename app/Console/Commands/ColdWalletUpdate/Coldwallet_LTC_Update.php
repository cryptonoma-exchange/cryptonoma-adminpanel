<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Traits\Litecoin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Coldwalletaddress;
use App\Models\UserLtcAddress;

class Coldwallet_LTC_Update extends Command
{
    use Litecoin;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ltc_cold_wallet';

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
                $send  = $this->createUserLtcTransaction($uid,$total,$fee);
                if(!empty($send->txId)){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
            sleep(1);
        }
    }

    function createUserLtcTransaction($uid,$amt,$fee=0.0001){
        $cold_wallet_address = Coldwalletaddress::first();
        $toaddress = $cold_wallet_address->ltc_address;
        $userdetails = UserLtcAddress::where(['user_id'=> $uid])->first();
        if($userdetails){
            $toaddress = $toaddress;
            $fromaddress = $userdetails->address;
            $credential = explode(',',$userdetails->narcanru);
            $pvtkey = Crypt::decryptString($credential[2]);
            $send = $this->send_ltc($toaddress, $amt, $fromaddress,$pvtkey, $fee);
            return $send;
        }
        return false;
    }
}
