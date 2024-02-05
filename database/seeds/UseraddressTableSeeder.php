<?php

use Illuminate\Database\Seeder;
 
class UseraddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       DB::table('user_address')->insert(
        [
            'asset'         => 'BTC',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

        DB::table('user_address')->insert(
        [
            'asset'         => 'BCH',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

        DB::table('user_address')->insert(
        [
            'asset'         => 'EURS',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

        DB::table('user_address')->insert(
        [
            'asset'         => 'USDS',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

        DB::table('user_address')->insert(
        [
            'asset'         => 'HKDS',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

        DB::table('user_address')->insert(
        [
            'asset'         => 'GBPS',
            'address'       => '',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);

    }
}
