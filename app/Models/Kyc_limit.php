<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kyc_limit extends Model
{
    protected $connection = 'mysql2'; 
    protected $table = 'kyc_per_month_limit'; 
  
}
