<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DepositUpdate\BalanceBchUpdate::class,
        Commands\DepositUpdate\BalanceBnbUpdate::class,
        Commands\DepositUpdate\BalanceBtcUpdate::class,
        Commands\DepositUpdate\BalanceEthUpdate::class,
        Commands\DepositUpdate\BalanceLtcUpdate::class,
        Commands\DepositUpdate\BalanceXrpUpdate::class,
        Commands\DepositUpdate\BalanceBep20Update::class,
        Commands\DepositUpdate\BalanceErc20Update::class,

        Commands\ColdWalletUpdate\Coldwallet_BCH_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_BNB_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_BTC_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_ETH_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_LTC_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_XRP_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_BEP20_Update::class,
        Commands\ColdWalletUpdate\Coldwallet_ERC20_Update::class,

        Commands\FeeMove\FeeMoveBep20::class,
        Commands\FeeMove\FeeMoveErc20::class,

        Commands\GenerateAddress::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('deposit_update:bch')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('deposit_update:bnb')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('deposit_update:btc')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('deposit_update:eth')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('deposit_update:ltc')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('deposit_update:xrp')->everyFiveMinutes()->withoutOverlapping();

        $schedule->command('deposit_update:erc20')->everyFiveMinutes()->withoutOverlapping();

        $schedule->command('update:bch_cold_wallet')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:bnb_cold_wallet')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:btc_cold_wallet')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:eth_cold_wallet')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:ltc_cold_wallet')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:xrp_cold_wallet')->everyFiveMinutes()->withoutOverlapping();

        $schedule->command('address:generate')->everyFifteenMinutes()->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
