<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffilateCommission extends Model
{
    protected $connection = 'mysql2';
    protected $table ='affilate_commission';


    public static function index()
    {
    	$commission = AffilateCommission::paginate(10);

    	return $commission;
    }

    public static function coindetails($coin)
    {
        $commission = AffilateCommission::where('source', $coin)->first();
        return $commission;
    }

    public static function edit($id)
    {
    	$commission = AffilateCommission::where('id', $id)->first();

    	return $commission;
    }

    public static function commissionUpdate($request)
    {
    	$commission = AffilateCommission::where('id', $request->id)->first();
        $commission->coin  = $request->coin_name;
        $commission->deposit  = $request->deposit;
        $commission->trade = $request->trade; 
        $commission->save();

        return true;   
    }


  }
