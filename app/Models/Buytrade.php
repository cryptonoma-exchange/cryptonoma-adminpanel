<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buytrade extends Model
{
    protected $table = 'bitcoinx_buytrades';
    protected $connection = 'mysql2';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
