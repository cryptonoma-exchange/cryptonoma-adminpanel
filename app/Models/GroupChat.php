<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    protected $connection = 'mysql2';
    public static function index()
    {
    	$chat = GroupChat::get();
    	return $chat;
    }

}
