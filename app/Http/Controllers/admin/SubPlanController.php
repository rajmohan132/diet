<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\SubPlan;
use App\Models\Plan;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Artisan;

class SubPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subplan = SubPlan::latest();
    
        return view('subplan-list',compact('subplan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // public function plan()
    // {
    //     $plan = Plan::where('status', 1)->get();
    //     dd($plan);
    //     return view('subplan-add', compact('plan'));
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = Plan::where('status', 1)->get();
        $subplan =  SubPlan::All();
        $sub_plan_number  = 0;
        $sub_plan_number = count($subplan)+1;
        $subplancode = "SP000".$sub_plan_number;
        return view('subplan-add',compact('plan','subplancode'));
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
            'subplancode' => 'required',
            'splanname' => 'required',
            'planname' => 'required',
            'status' => 'required',
            
        ]);
        $input = $request->all();
        SubPlan::create($input);
        return redirect()->route('subplan-add.create')
                        ->with('success','Plan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubPlan  $subPlan
     * @return \Illuminate\Http\Response
     */
    public function show(SubPlan $subPlan)
    {
        //
        $subplan = SubPlan::join('plans', 'plans.id','=' ,'sub_plans.planname'  )
                            ->select('*')
                            ->selectRaw('sub_plans.status as spstatus')
                             ->get();
                
        return view('subplan-list',compact('subplan'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubPlan  $subPlan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $subplan = SubPlan::find($id);
        $plan = Plan::where('status', 1)->get();
        return view('subplan-edit',['plan'=>$plan , 'subplan'=>$subplan]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubPlan  $subPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        $subid = $request['subplanid'];
        $subplan = SubPlan::find($subid);
        $request->validate([
            'subplancode' => 'required',
            'splanname' => 'required',
            'planname' => 'required',
            'status' => 'required',
            
        ]);
        $subplan->subplancode = $request['subplancode'];
        $subplan->splanname = $request['splanname'];
        $subplan->planname = $request['planname'];
        $subplan->status = $request['status'];
        $subplan->proc_nice = $request['proc_nice'];
        
        $subplan->update();
        return redirect()->route('subplan-add.create')
                        ->with('success','Plan updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubPlan  $subPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubPlan $subPlan)
    {
        //
    }

    public function updateStatus($id)
    {
        //

        $subplan = SubPlan::find($id);
        $subplan->status = "0";
        $subplan->update();
        return redirect()->route('subplan-add.create')
                        ->with('success','Plan updated successfully.');

    }

    public function filter_sub_plan(Request $request){

        $plan = $request['plan'];
        $subplan = Product::where('plan', $plan)->pluck('subplan')->toArray();    
        $subplan = SubPlan::where('status',1)
                       ->where('planname' , $plan)
                       ->whereIn('id', $subplan)
                       ->get(); 
        return json_encode($subplan);
    }

    public function product_filter_sub_plan(Request $request){
        $plan = $request['plan'];
        $subplan = SubPlan::where('status',1)
                       ->where('planname' , $plan)
                       ->get(); 
        return json_encode($subplan);
    }

    public function get_subplan_price(Request $request){
        $price = SubPlan::where('id', $request->subplan)->value('price');
        return response()->json(['price'=>$price]);
    }

}
