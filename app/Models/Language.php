<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $connection = 'mysql2';
    public static function index()
    {
    	$chat = Language::get();
    	return $chat;
    }
}
