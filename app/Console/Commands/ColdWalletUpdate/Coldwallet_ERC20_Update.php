<?php

namespace App\Console\Commands\ColdWalletUpdate;

use Illuminate\Console\Command;
use App\Models\Commission;
use App\Models\CryptoTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Coldwalletaddress;
use App\Models\TokenAddress;
use App\Traits\Ethereum;
use App\Models\TokenMultinetwork;

class Coldwallet_ERC20_Update extends Command
{
    use Ethereum;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:erc20_cold_wallet';

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
        $tokens = TokenMultinetwork::with(["coin"])->where("network",$network)->get();
        foreach ($tokens as $token) {
            $coin = $token->coin;
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
                ['feestatus','=',1],
                ['network',"=",$network],
                ["currency","=",$symbol]
            ])
            ->groupBy('to_addr')
            ->get();
            foreach ($transactions as $transaction) {
                $ids = explode(',',$transaction->ids);
                $uids = explode(',',$transaction->uids);
                $uid    = $uids[0];
                $amount = $transaction->amt * pow(10,$token->crypto_precision);
                $send = $this->createUserErc20Transaction($uid,$amount,$token);
                if(!empty($send)){
                    CryptoTransactions::whereIn("id",$ids)->update(['nirvaki_nilai' => 1]);
                }
                sleep(1);
            }
        }
    }

    public function createUserErc20Transaction($uid,$amt,$token){
        try {
            $cold_wallet_address = Coldwalletaddress::first();
            $toaddress = $cold_wallet_address->eth_address;
            $contract_address = $token->contractaddress;
            $userdetails = TokenAddress::where([
                ['uid',"=",$uid]
            ])->first();
            if($toaddress && $userdetails && $contract_address){
                $fromaddress = $userdetails->address;
                $credential = explode(',',$userdetails->narcanru);
                $pvtkey = Crypt::decrypt($credential[0]);
                $gasPrice = $this->getLivePrice();
                $gasLimit = 100000;
                $send = $this->sendErc20Token($pvtkey,$gasPrice,$gasLimit,$contract_address,$amt,$fromaddress,$toaddress);
                if(isset($send->txid) && !empty($send->txid)){
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
