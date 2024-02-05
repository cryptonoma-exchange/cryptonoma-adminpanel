<?php

namespace App\Models;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'bitcoinx_testimonial';

        protected $connection = 'mysql2';

    //    public static function saveFaq($request)
    // {

    //   $savepath=\Config::get('filesystems.disks.public.kyc');    
    //    $fromemail=\Config::get('mail.from.address'); 

    //     if(Input::hasFile('front_upload_id')){
    //             $dir = 'kyc/';        
    //             $fornt = Input::File('front_upload_id'); 
    //             $filenamewithextension = $fornt->getClientOriginalName();
    //             $photnam = str_replace('.','',microtime(true));
    //             $filename = pathinfo($photnam, PATHINFO_FILENAME);
    //             $extension = $fornt->getClientOriginalExtension();
    //             $photo = $filename.'.'. $extension;
    //             $fornt->move($savepath, $photo);
    //             $front_img = $savepath.$photo;
    //       }
    // 	$features = new Testimonial();
    // 	$features->setConnection('mysql2');
    //     $features->heading = $request->heading;
    //     $features->desc = $request->description;
    //     $features->img =  $front_img;
  
    //     $features->save(); 

    //     return true;
    // }

    public static function edit($id)
    {
    	$faq = Testimonial::on('mysql2')->where('id',$id)->first(); 

    	return $faq;
    }

    public static function remove($id)
    {
        $faq = Testimonial::on('mysql2')->where('id',$id)->delete(); 

        return $faq;
    }

    // public static function faqUpdate($request)
    // {
    // 	$features = Testimonial::on('mysql2')->where('id',$request->id)->first();
    //     $features->heading = $request->heading;
    //     $features->desc = $request->description;
    //     $features->save(); 

    //     return $faq='Updated Successfully';
    // }
}
