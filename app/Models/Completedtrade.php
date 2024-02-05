<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Completedtrade extends Model
{
    protected $table = 'bitcoinx_completedtrades';
	protected $connection = 'mysql2';
}
