<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawaddress extends Model
{
    protected $table = 'bitcoinx_withdraw_address';
    protected $connection = 'mysql2';
}
