<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Holiday;
use App\Models\Referral;
use Illuminate\Http\Request;
use DB;

class GeneralSettingController extends Controller
{
    
    public function holiday(){
        $pageTitle = 'Holiday Settings';
        $holidays = Holiday::paginate(getPaginate());
        $emptyMessage = 'Holidays not found';
        return view('admin.setting.holiday',compact('pageTitle','holidays','emptyMessage'));
    }

    public function holidayStore(Request $request){
        $request->validate([
            'date'=>'required|date'
        ]);
        $holiday = new Holiday();
        $holiday->date = $request->date;
        $holiday->save();
        return back()->with('success','Holiday added successfully');
    }

    public function holidayDelete($id){
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();
        return back()->with('success','Holiday deleted successfully');
    }

    public function offDay(Request $request){
        $general = GeneralSetting::first();
        if(@count($request->off_day) == 7){
            return back()->with('error','You couldn\'t add all day as holiday');
        }

        $general->off_day = $request->off_day;
        $general->save();
        return back()->with('success','Weekly holiday setting updated');
    }

    public function referralSetting(){
        $pageTitle = 'Referral Commission Setting';
        $referrals = Referral::get();
        $commissionTypes = [
            'deposit_commission'=>'Deposit Commission',
            'invest_commission'=>'Invest Commission',
            'interest_commission'=>'Interest Commission',
        ];
         $general = DB::table('general_settings')->first(); 
        return view('referral.index',compact('pageTitle','referrals','commissionTypes','general'));
    }

    public function referralSettingStatus($type){
        $general = GeneralSetting::first();
        if (@$general->$type == 1) {
            @$general->$type = 0;
        }else{
            @$general->$type = 1;
        }
        $general->save();
        return back()->with('success', 'Referral commission status updated successfully');
    }

    public function referralStoreLevel(Request $request){
        $request->validate([
            'percent*' => 'required|numeric',
            'commission_type' => 'required|in:deposit_commission,invest_commission,interest_commission',
        ]);
        $type = $request->commission_type;

        Referral::where('commission_type',$type)->delete();

        for ($i = 0; $i < count($request->percent); $i++){
            $referral = new Referral();
            $referral->level = $i + 1;
            $referral->percent = $request->percent[$i];
            $referral->commission_type = $request->commission_type;
            $referral->save();
        }

        $notify[] = ['success','Referral commission setting updated successfully'];
        return back()->with('success','Referral commission setting updated successfully');
    }
}
