<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\Coldwalletaddress;
use App\Models\AdminFeeWallet;
use App\Traits\Ripple;
use Illuminate\Support\Facades\Crypt;

class Coldwallet_XRP_Update extends Command
{
    use Ripple;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:xrp_cold_wallet';

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
            $fromaddress = $transaction->to_addr;
            if($total > 0.00001){
                $send  = $this->createUserXrpTransaction($fromaddress,$total,$fee);
                if(!isset($send->error) && !empty($send)){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
            sleep(1);
        }
    }

    function createUserXrpTransaction($fromaddress,$amt,$fee){
        $cold_wallet_address = Coldwalletaddress::first();
        $toaddress = $cold_wallet_address->xrp_address;
        $tag = $cold_wallet_address->xrp_tag;
        $userdetails = AdminFeeWallet::where('coinname', 'XRP')->where("address",$fromaddress)->first();
        if($userdetails){
            $toaddress = $toaddress;
            $fromaddress = $userdetails->address;
            $credential = explode(',',$userdetails->narcanru);
            $pvtkey = Crypt::decrypt($credential[0]);
            $send = $this->sendxrp($toaddress, $amt, $fromaddress,$pvtkey, $tag);
            return $send;
        }
        return false;
    }

}
