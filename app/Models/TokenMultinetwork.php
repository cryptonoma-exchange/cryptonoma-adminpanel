<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TokenMultinetwork extends Model
{
	protected $guarded = [];
	protected $table = 'token_multinetwork';
	protected $connection ='mysql2';

	public function coin()
	{
		return $this->belongsTo(\App\Models\Commission::class,"coin_id");
	}
}
