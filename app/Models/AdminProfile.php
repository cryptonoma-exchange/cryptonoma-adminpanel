<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class AdminProfile extends Model
{
  protected $connection = 'mysql';
  protected $table = 'bitcoinx_user_profiles'; 

 public static function adminprofile() {
    $adminid = Session::get('adminId');
    $admin = AdminProfile::where(['user_id' => $adminid])->first();  
    return $admin;
}


}
