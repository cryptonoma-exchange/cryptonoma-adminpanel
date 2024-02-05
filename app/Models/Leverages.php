<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leverages extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'leverages'; 


    public static function index()
    {
    	$commission = Leverages::on('mysql2')->paginate(10);

    	return $commission;
    }

   
    public static function le_edit($id)
    {
    	$commission = Leverages::on('mysql2')->where('id', $id)->first();

    	return $commission;
    }

    public static function le_commissionUpdate($request)
    {

    	$commission = Leverages::on('mysql2')->where('id', $request->id)->first();
    	$commission->id        = $request->id; 
        $commission->title  = $request->title;
        $commission->value = $request->value; 
        $commission->commission = $request->commission;
        $commission->save();

        return true;   
    }

    public static function le_commissionadd($request)
    {

        //dd($request);
        $commission = new Leverages();
        $commission->title  = $request->title;
        $commission->value = $request->value; 
        $commission->commission = $request->commission;
        $commission->save();

        return true;   
    }
     public static function le_remove($id)
    {
        $commission = Leverages::on('mysql2')->where('id', $id)->delete();

        return $commission;
    }
}
