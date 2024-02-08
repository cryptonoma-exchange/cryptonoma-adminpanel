<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\TimeSetting;
use Illuminate\Http\Request;
use DB;

class PlanController extends Controller
{
    public function index(){
        $pageTitle = 'Plans';
        $times = TimeSetting::get();
        $plans = Plan::get();
        $emptyMessage = 'No plan found';
        $general = DB::table('general_settings')->first(); 
        return view('plan.index',compact('pageTitle','times','plans','emptyMessage','general'));
    }

    public function savePlan(Request $request,$id = null){
        $this->validation($request);

        $time = TimeSetting::where('time',$request->time)->firstOrFail();

        if($id){
            $plan = Plan::findOrFail($id);
            $plan->status = $request->status ? 1 : 0;
            $notify[] = ['success','Plan updated successfully'];
        }else{
            $plan = new Plan();
            $notify[] = ['success','Plan added successfully'];
        }
        $plan->name = $request->name;
        $plan->minimum = $request->minimum ?? 0;
        $plan->maximum = $request->maximum ?? 0;
        $plan->fixed_amount = $request->amount ?? 0;

        $plan->interest = $request->interest;
        $plan->interest_type = $request->interest_type == 1 ? 1 : 0;
        $plan->time = $time->time;
        $plan->time_name = $time->name;
        $plan->capital_back = $request->capital_back ?? 0;
        $plan->life_time = $request->return_type == 1 ? 1 : 0;
        $plan->repeat_time = $request->repeat_time ?? 0;
        $plan->save();

        return back()->withNotify($notify);
    }

    protected function validation($request){
        $request->validate([
            'name'          => 'required',
            'invest_type'   => 'required|in:1,2',
            'interest_type' => 'required|in:1,2',
            'interest'      => 'required|numeric|gt:0',
            'time'          => 'required|integer|gt:0',
            'return_type'   => 'required|integer|in:1,2',
            'minimum'       => 'nullable|required_if:invest_type,1|gt:0',
            'maximum'       => 'nullable|required_if:invest_type,1|gt:minimum',
            'amount'        => 'nullable|required_if:invest_type,2|gt:0',
            'repeat_time'   => 'nullable|required_if:return_type,2|integer|gt:0',
            'capital_back'  => 'nullable|required_if:return_type,2|in:1,0',
        ]);

    }
}

