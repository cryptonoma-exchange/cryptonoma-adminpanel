<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = 'bitcoinx_cms';


    public static function index()
    {
        $terms = CMS::on('mysql2')->where('id', 1)->first();
        return $terms;
    }

    public static function updateTerms($request)
    {
        $tc = $request->tc;
        $tc = str_replace("\r\n", '<br />', $tc);
        $message = "";
        if ($tc != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['tc' => $tc]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatecrypto($request)
    {
        $tc = $request->crypto;
        $tc = str_replace("\r\n", '<br />', $tc);
        $message = "";
        if ($tc != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['crypto' => $tc]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatecredit($request)
    {
        $tc = $request->credit;
        $tc = str_replace("\r\n", '<br />', $tc);
        $message = "";
        if ($tc != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['credit' => $tc]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatePrivacy($request)
    {
        $privacy_policy = $request->privacy;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['privacy_policy' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatewarning($request)
    {
        $privacy_policy = $request->warning;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['warning' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatewebdisclaimer($request)
    {
        $privacy_policy = $request->webdisclaimer;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['webdisclaimer' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatemobileappdescription($request)
    {
        $privacy_policy = $request->mobileappdescription;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['mobileappdescription' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatelistingstatus($request)
    {
        $privacy_policy = $request->listingstatus;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['listingstatus' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }


    public static function updatesecuritypage($request)
    {
        $privacy_policy = $request->securitypage;
        $privacy_policy = str_replace("\r\n", '<br />', $privacy_policy);

        if ($privacy_policy != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['securitypage' => $privacy_policy]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatePrivacyServices($request)
    {
        $termsservice = $request->termsservice;
        $termsservice = str_replace("\r\n", '<br />', $termsservice);

        if ($termsservice != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['termsservice' => $termsservice]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateHomepage($request)
    {

        $homebanner_title = $request->homebanner_title;
        $homebanner_title = str_replace("\r\n", '<br />', $homebanner_title);

        $homebanner = $request->homebanner;
        $homebanner = str_replace("\r\n", '', $homebanner);

        if ($homebanner_title != '' && $homebanner) {
            $update = CMS::on('mysql2')->where('id', 1)->update(['homebanner_title' => $homebanner_title, 'homebanner' => $homebanner]);

            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateLivepage($request)
    {
        $livepriceupdate = $request->liveprice;
        /* 

        if($livepriceupdate)
        {*/
        $update = CMS::on('mysql2')->where('id', 1)->update(['homepage_liveprice_view' => $livepriceupdate]);

        if ($update) {
            $message = "Updated Successfully!";
        } else {
            $message = "Fields Are Empty. Try Again!";
        }
        /*   }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }*/

        return $message;
    }

    public static function updateAbout($request)
    {
        $aboutus = $request->aboutus;
        $aboutus = str_replace("\r\n", '<br />', $aboutus);
        if ($aboutus != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['aboutus' => $aboutus]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateMpisa($request)
    {
        $one = $request->mpisa_description;
        $two = $request->mpisa_mobile_description;
        $three= $request->mpisa_description_withdraw;
        $four = $request->mpisa_mobile_description_withdraw;
        $one = str_replace("\r\n", '<br />', $one);
        $two = str_replace("\r\n", '<br />', $two);
        $three = str_replace("\r\n", '<br />', $three);
        $four = str_replace("\r\n", '<br />', $four);
        if ($one != '' ) {
            $update = CMS::on('mysql2')->where('id', 1)->update(['mpisa_description' => $one, 'mpisa_mobile_description' => $two,'mpisa_description_withdraw' =>  $three, 'mpisa_mobile_description_withdraw' => $four]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateKyc($request)
    {

        //dd($request->kyc_content);
        $kyc_content = str_replace("\r\n", '<br />', $request->kyc_content);
        $kycaccess = $request->kycaccess;
        $twofawithdraw = $request->twofawithdraw;

        /*if($kyc_content !='')
        {*/
        $update = CMS::on('mysql2')->where('id', 1)->update(['kyc_content' => $kyc_content, 'kyc_enable' => $kycaccess, 'twofa_withdraw_enable' => $twofawithdraw]);
        if ($update) {
            $message = "Updated Successfully!";
        }
        /*}
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }*/

        return $message;
    }

    public static function updateAml($request)
    {
        $aml = $request->aml;
        $aml = str_replace("\r\n", '<br />', $aml);
        $message = "";
        if ($aml != '') {
            $update = CMS::on('mysql2')->where('id', 1)->update(['aml' => $aml]);
            if ($update) {
                $message = "Updated Successfully!";
            }
        } else {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateFeatures($request)
    {
    	// for($i=1;$i<=sizeof($request->heading);$i++)
        // {   
            // $features = Features::on('mysql2')->where('id',$i)->first();
            // $features->heading = $request->heading[$i-1];
            // $features->desc = $request->description[$i-1];
            // $features->save(); 
     //   }
        // if(isset($request->textcontent)){
            $featuretext = CMS::on('mysql2')->where('id',1)->first();
            $featuretext->statisticsone_data = $request->statisticsone_data;
            $featuretext->statisticsone_number = $request->statisticsone_number;
            $featuretext->statisticstwo_data = $request->statisticstwo_data;
            $featuretext->statisticstwo_number = $request->statisticstwo_number;
            $featuretext->statisticsthree_data = $request->statisticsthree_data;
            $featuretext->statisticsthree_number = $request->statisticsthree_number;
            $featuretext->save();
      //  }

        return $message = "Updated Successfully!";
    }
}
