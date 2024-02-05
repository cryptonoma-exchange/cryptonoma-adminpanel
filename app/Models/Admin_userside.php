<?php
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Admin_userside extends Authenticatable 
{	
	protected $table = "bitcoinx_admin";
	protected $connection = "mysql2";
	protected $guarded = [];
}
	