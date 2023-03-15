<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Validator;
use Artisan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = Plan::latest()->paginate(10);
    
        return view('plan-list',compact('plan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $plan =  Plan::All();
        $plan_number  = 0;
        $plan_number = count($plan)+1;
        $plan_code = "PL000".$plan_number;
        return view('plan-add',['plancode'=>$plan_code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'plancode' => 'required',
            'planname' => 'required',
            'planmessage' => 'required',
            'status' => 'required',
            
        ]);
        $input = $request->all();

        $plan = new Plan;

        if ($image = $request->file('planimage')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);                 
            $image->storeAs('public/planimages', $profileImage);
            $plan->planimage = $profileImage;
        }
    
        $plan->plancode = $request->plancode;
        $plan->planname = $request->planname;
        $plan->planmessage = $request->planmessage;
        $plan->status = $request->status;
        $plan->num_days = $request->num_days;
        
      
        $plan->save();

     
        return redirect()->route('plan-add.create')
                        ->with('success','Plan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $plan = Plan::find($id);
        return view('plan-edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $planid = $request->plan_id;
        $plan = Plan::find($planid);
        $request->validate([
            'plancode' => 'required',
            'planname' => 'required',
            'planmessage' => 'required',
            'status' => 'required',
            
        ]);
        $input = $request->all();

        if ($image = $request->file('planimage')) {
           
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
                               
            $image->storeAs('public/planimages', $profileImage);
            $plan->planimage = $profileImage;

        }
        $plan->plancode = $request->plancode;
        $plan->planname = $request->planname;
        $plan->planmessage = $request->planmessage;
        $plan->status = $request->status;
       
      
        $plan->update();
        return redirect()->route('plan-add.create')
                        ->with('success','Plan updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        //

        $plan = Plan::find($id);
        $plan->status = "0";
        $plan->update();
        return redirect()->route('plan-add.create')
                        ->with('success','Plan deleted successfully.');

    }

     public function find_num_days(Request $request){

        $plan = $request['plan'];
        $plan_ = Plan::find($plan);
        return json_encode($plan_);
    }
}
