<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin_userside;
use App\Traits\GoogleAuthenticator;

class Admin extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bitcoinx_admins';

    use GoogleAuthenticator;

    public function login($request)
    {
        $data = [
            "status" => false,
            "message" => 'Incorrect email or password!'
        ];
        $admin = Admin::where('email', $request->email)->first();
        if (isset($admin->password) && password_verify($request->password, $admin->password)) {
            if($admin->google2fa_verify == 1){
                if(empty($request->code)){
                    $data["message"] = "Authentication Code Required!";
                    return $data;
                }
                $verification = $this->verifyCode($admin->google2fa_secret, $request->code, 2);
                if($verification){
                    $data["status"] = true;
                    return $data;
                } else {
                    $data["message"] = "Invalid Authentication Code!";
                    return $data;
                }
            }
            $data["status"] = true;
            return $data;
        }
        return $data;
    }

    public static function updateUsername($request)
    {
        $email = $request->email;
        $admin = Admin::where('id', \Session::get('adminId'))->first();
        $admin->email = $email;
        $admin->notify_mail1 = $request->notify_mail1;
        $admin->notify_mail2 = $request->notify_mail2;
        if ($admin->save()) {
            if (\Session::get('adminId') == 1) {
                $Admin_userside = Admin_userside::where('id', 1)->first();
                $Admin_userside->email = $request->email;
                $Admin_userside->save();
            }
            return $messgae = "Email Changed Successfully";
        }
    }

    public static function changepassword($request)
    {
        $currentpassword = $request->currentpassword;
        $new_password = $request->password;
        $confirm_password = $request->password_confirmation;
        $admin = Admin::where('id', \Session::get('adminId'))->first();
        if (!(Hash::check($currentpassword, $admin->password))) {
            return $messgae = "Your current password does not match with the password you provided. Please try again!";
        } else if (strlen($new_password) <= 7) {
            return $messgae = "Password length should be minimum 8 characters!";
        } else {
            if ($new_password == $confirm_password) {
                $password = bcrypt($new_password);
                $admin->password = $password;
                if ($admin->save()) {
                    return $messgae = "Password Changed Successfully!";
                }
            } else {
                return $messgae = "Password Mismatch!";
            }
        }
    }

    public static function subadmin_date_search($startdate, $enddate)
    {
        $search = Admin::on('mysql')
            ->whereDate('created_at', '>=', $startdate)
            ->whereDate('created_at', '<=', $enddate)
            ->where('type', '=', 2)
            ->select('*')
            ->orderBy('updated_at', 'desc')
            ->paginate(25);
        return $search;
    }
}
