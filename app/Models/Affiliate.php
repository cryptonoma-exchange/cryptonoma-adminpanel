<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $table = "bitcoinx_affiliate";


        public static function updatereferral($request)
    {

        $level1 = $request->level1;

        $level2 = $request->level2;

        $level3 = $request->level3;

        $bonuslevel1 = $request->bonuslevel1;
        $bonuslevel2 = $request->bonuslevel2;
        $bonuslevel3 = $request->bonuslevel3;
        $regbonus = $request->regbonus;

        if($level1 !='' && $level2 !=''&& $level3 !=''&& $bonuslevel1 !=''&& $bonuslevel2 !=''&& $bonuslevel3 !=''&& $regbonus !='')
        {
            $update = Affiliate::on('mysql2')->where('id', 1)->update(['level1' => $level1 , 'level2' => $level2,'level3' => $level3,'bonuslevel1' => $bonuslevel1,'bonuslevel2' => $bonuslevel2,'bonuslevel3' => $bonuslevel3,'regbonus' => $regbonus]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }
}
