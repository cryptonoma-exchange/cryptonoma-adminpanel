<?php

namespace App\Console\Commands\FeeMove;

use App\Traits\Bep;
use App\Models\Commission;
use App\Models\AdminFeeWallet;
use Illuminate\Console\Command;
use App\Models\Coldwalletaddress;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FeeMoveBep20 extends Command
{
    use Bep;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fee_move:bep20';

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
        $network = "BEP20";
        $coins = Commission::where("type","token")->where("network",$network)->get();
        foreach ($coins as $coin) {
            $symbol = $coin->source;
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
                ['feestatus','=',0],
                ['network',"=",$network],
                ["currency","=",$symbol]
            ])
            ->groupBy('to_addr')
            ->get();
            foreach ($transactions as $transaction) {
                $ids = explode(',',$transaction->ids);
                $gasPrice = 50*pow(10,8);
                $fee = $this->calculatebnbfee($gasPrice);
                $to_address = $transaction->to_addr;
                $send = $this->createUserBnbTransaction($fee,$gasPrice,$to_address);
                if($send){
                    CryptoTransactions::whereIn("id",$ids)->update(['feestatus' => 1]);
                }
            }
        }
    }

    public function createUserBnbTransaction($amount,$gasprice,$toaddress){
        try {
            $admin_fee_wallet = AdminFeeWallet::where("coinname","BNB")->first();
            if($admin_fee_wallet){
                $fromaddress = $admin_fee_wallet->address;
                $credential = explode(',', $admin_fee_wallet->narcanru);
                $pvk = Crypt::decrypt($credential[0]);
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
