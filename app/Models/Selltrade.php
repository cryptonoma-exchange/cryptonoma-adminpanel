<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selltrade extends Model
{
    protected $table = 'bitcoinx_selltrades';
    protected $connection = 'mysql2';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
