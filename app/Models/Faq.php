<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{


    protected $table = "bitcoinx_faqs";
    protected $connection = "mysql2";

    
    public static function saveFaq($request)
    {
    	$features = new Faq();
    	$features->setConnection('mysql2');
        $features->heading = $request->heading;
        $features->desc = $request->description;
        $features->save(); 

        return true;
    }

    public static function edit($id)
    {
    	$faq = Faq::on('mysql2')->where('id',$id)->first(); 

    	return $faq;
    }

    public static function remove($id)
    {
        $faq = Faq::on('mysql2')->where('id',$id)->delete(); 

        return $faq;
    }

    public static function faqUpdate($request)
    {
    	$features = Faq::on('mysql2')->where('id',$request->id)->first();
        $features->heading = $request->heading;
        $features->desc = $request->description;
        $features->save(); 

        return $faq='Updated Successfully';
    }
}
