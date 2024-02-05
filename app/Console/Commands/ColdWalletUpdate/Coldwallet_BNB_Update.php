<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\Coldwalletaddress;
use App\Models\UserBnbAddress;
use App\Traits\Bep;
use Illuminate\Support\Facades\Crypt;

class Coldwallet_BNB_Update extends Command
{
    use Bep;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bnb_cold_wallet';

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
        $transactions = CryptoTransactions::select([
            'to_addr',
            DB::raw('SUM(amount) as amt'),
            DB::raw("GROUP_CONCAT(id) AS ids"),
            DB::raw("GROUP_CONCAT(uid) AS uids")
        ])
            ->where([
                ["from_addr", "!=", "admindeposit"],
                ["txtype", "=", "deposit"],
                ['nirvaki_nilai', '=', 0],
                ['network',"=",$network],
                ["currency", "=", $symbol]
            ])
            ->groupBy('to_addr')
            ->get();
        foreach ($transactions as $transaction) {
            $ids = explode(',',$transaction->ids);
            $uids = explode(',',$transaction->uids);
            $uid    = $uids[0];
            $amount = $transaction->amt;
            if ($amount > 0) {
                $gasprice = 50*pow(10,8);
                $fee = $this->calculatebnbfee($gasprice);
                $total  = ncSub($amount, $fee, 8);
                $send   = $this->createUserBnbTransaction($uid, $total, $gasprice);
                if($send){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
            }
            sleep(1);
        }
    }

    public function createUserBnbTransaction($uid,$amount,$gasprice){
        try {
            $cold_wallet_address = Coldwalletaddress::first();
            $toaddress = $cold_wallet_address->bnb_address;
            $userdetails = UserBnbAddress::where(['user_id'=> $uid])->first();
            if($toaddress && $userdetails){
                $fromaddress = $userdetails->address;
                $credential = explode(',', $userdetails->narcanru);
                $pvk = Crypt::decrypt($credential[1]);
                $send = $this->bepWithdrawSendTransaction($fromaddress, $toaddress, $amount, $pvk);
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

    public function calculatebnbfee($gasprice)
    {
        $gaspricelimit = 57000;
        $amount = $gasprice * $gaspricelimit;
        return $amount / pow(10,18);
    }
}


