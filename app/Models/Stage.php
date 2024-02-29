<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    

	public function coin()
	{
		return $this->belongsTo(\App\Models\Commission::class,"coin_id");
	}

}
