<?php

namespace App\Console\Commands\FeeMove;

use Illuminate\Console\Command;
use App\Models\Commission;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\AdminFeeWallet;
use App\Traits\Ethereum;
use Illuminate\Support\Facades\Crypt;

class FeeMoveErc20 extends Command
{
    use Ethereum;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fee_move:erc20';

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
        $network = "ERC20";
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
                $gasPrice = $this->getLivePrice();
                $total = 100000 * $gasPrice;
                $total = $this->weitoeth($gasPrice);
                $to_address = $transaction->address;
                $send = $this->createUserEthTransaction($total,$gasPrice,$to_address);
                if($send){
                    CryptoTransactions::whereIn("id",$ids)->update(['feestatus' => 1]);
                }
            }
        }
    }

    function createUserEthTransaction($amt,$gasPrice,$to_address){
        try {
            $admin_fee_wallet = AdminFeeWallet::where("coinname","ETH")->first();
            if($admin_fee_wallet){
                $from_address = $admin_fee_wallet->address;
                $credential = explode(',',$admin_fee_wallet->narcanru);
                $pvtkey = Crypt::decrypt($credential[0]);
                $send = $this->ethSendTransaction($from_address,$to_address,$amt,$pvtkey,$gasPrice);
                if (isset($send->txid) && !empty($send->txid)) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
