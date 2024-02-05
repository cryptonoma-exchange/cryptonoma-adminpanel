<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	
	protected $connection = 'mysql2';
	protected $table = 'contact';
	

	public static function contact_view(){

		return Contact::on('mysql2')->orderBy('id', 'desc')->paginate(25);

	}
	



}
