<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coinuser;
use App\Traits\AddressCreation;

class GenerateAddress extends Command
{
    use AddressCreation;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address:generate';

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
        $users = Coinuser::where("kyc_verify",1)->get();
        foreach ($users as $user) {
            $this->userAddressCreation($user->id); 
            sleep(1);
        }
    }
}
