<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;



class Coldwalletaddress extends Model
{   


    protected $connection = 'mysql2';
    protected $table ='bitcoinx_coldwalletaddresses';
    protected $fillable = ['btc_address', 'bnb_address','ltc_address','xrp_address','bch_address','eth_address'];

  }
