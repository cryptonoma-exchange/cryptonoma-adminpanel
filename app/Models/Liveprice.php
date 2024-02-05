<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liveprice extends Model
{
    protected $table ='bitcoinx_live_price';
    protected $connection = 'mysql2';

}
