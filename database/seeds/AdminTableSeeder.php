<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
        [
            'email'         => 'superadmin@cryptonoma.com',
            'password'      => bcrypt('wQBp2c].GGKbJwGp'),   
            'google2fa_secret' => '2QJYSGGRLEAIDPIW',    
            'google2fa_verify' => 0,       
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
