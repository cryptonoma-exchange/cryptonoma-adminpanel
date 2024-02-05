<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowWorks extends Model
{
    protected $table = "bitcoinx_how_it_works";
    protected $connection = "mysql2";

    public static function updateHowWorks($request)
    {
    	for($i=1;$i<=sizeof($request->heading);$i++)
        {   
            $features = HowWorks::on('mysql2')->where('id',$i)->first();
            $features->title = $request->heading[$i-1];
            $features->desc = $request->description[$i-1];
            $features->save(); 
        }

        return $message = "Updated Successfully!";
    }
}
