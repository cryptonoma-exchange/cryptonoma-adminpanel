<?php

use Illuminate\Database\Seeder;

class AdminFeeWalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_fee_wallet')->insert(
        [
            'coinname'         => 'ETH',
            'address'      => '',    
            'narcanru'      => '',    
            'fee'      => '0.0010914',    
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
