<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSetting;
use Illuminate\Http\Request;

class TimeSettingController extends Controller
{
    public function index(){
        $pageTitle      = 'Times';
        $times          = TimeSetting::get();
        $emptyMessage   = 'Time not found';
        return view('times.index',compact('pageTitle','times','emptyMessage'));
    }

    public function saveTime(Request $request, $id = 0){
        $request->validate([
            'name'=>'required',
            'time'=>'required|integer|gt:0',
        ]);
        if($id){
            $time = TimeSetting::findOrFail($id);
            $notification = 'Time updated successfully';
        }else{
            $time = new TimeSetting();
            $notification = 'Time added successfully';
        }
        $time->name = $request->name;
        $time->time = $request->time;
        $time->save();

        return back()->with('success', $notification);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id'=>'required|integer',
        ]);
        $time = TimeSetting::findOrFail($request->id);
        $time->delete();
        return back()->with('success','Time deleted successfully');
    }
}
