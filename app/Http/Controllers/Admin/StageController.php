<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Settings;
use App\Models\Commission;

class StageController extends Controller
{


    public function index(){
        return view('stages.index',[
            'stages' => Stage::orderByDesc('id')->get(),
            'settings' => Settings::where('id', '1')->first(),
            'title' => "Stages",
        ]);
    }

    public function create(){
        return view('stages.create',[
            'settings' => Settings::where('id', '1')->first(),
            'coins' => Commission::where('status', '1')->get(),
            'title' => "Add Stage",
        ]);
    }

    public function edit($id){
        return view('stages.update',[
            'stage' => Stage::where('id', $id)->first(),
            'settings' => Settings::where('id', '1')->first(),
            'coins' => Commission::where('status', '1')->get(),    
            'title' => "Update Stage",
        ]);
    }

    // Admin adds stage
    public function store(Request $request){
        $st = new Stage();
        $st->coin_id = $request->token_id;
        $st->stage_name = $request->stage_name;
        $st->token = $request->token;
        $st->token_avail = $request->token;
        $st->price = $request->price;
        $st->bonus = $request->bonus;
        $st->min = $request->min;
        $st->max = $request->max;
        $st->start_date = $request->startdate;
        $st->end_date = $request->enddate;
        
        // Check if social links exist in the request
        if ($request->has('social_links')) {
            // Convert social links array to JSON before storing
            $st->links = json_encode($request->social_links);
        } else {
            // If social links don't exist, store null
            $st->links = null;
        }

        $st->description = isset($request->description) ? $request->description : null;
        $st->status = "active";
        $st->sales = "on";
        $st->save();
        return redirect()->back()->with('success',"Stage Created Successfully");
    }

    // Admin Update stage
    public function update(Request $request){
        
        Stage::where('id', $request->stage_id)->update([
            'coin_id'=> $request->token_id,
            'stage_name'=> $request->stage_name,
            'token'=> $request->token,
            'token_avail' => $request->token,
            'price' => $request->price,
            'bonus' => $request->bonus,
            'min' => $request->min,
            'max' => $request->max,
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
        ]);

        return redirect()->back()->with('success',"Stage Updated Successfully");
    }

    // Admin adds stage
    public function markactive($id){
        
        Stage::where('id', $id)->update([
            'status' => "active",
        ]);

        return redirect()->back()->with('success',"Stage Marked as Active Successfully");
    }

    // Admin adds stage
    public function pausesales($id){
        
        Stage::where('id', $id)->update([
            'sales' => "paused",
        ]);

        return redirect()->back()->with('success',"Sales Paused Successfully for this stage");
    }

    public function resumesales($id){
        
        Stage::where('id', $id)->update([
            'sales' => "on",
        ]);

        return redirect()->back()->with('success',"Sales Resumed Successfully for this stage");
    }





}
