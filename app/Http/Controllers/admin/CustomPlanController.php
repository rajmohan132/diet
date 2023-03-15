<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Custom_plan;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Plan;
use App\Models\SubPlan;
use App\Models\Product;
use App\Models\Customer;
use  DB;

class CustomPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function subscrption_data()
    {
        $new_sub = DB::table('customer_plans')->where(['checked' => 0])->count();
        return response()->json([
            'success' => 1,
            'data' => ['new_sub' => $new_sub]
        ]);
        dd($new_sub);
    }

    public function create()
    {
        $customer = Customer::where('status',1)->get();

        $plan_in_product = Product::where([['status', 1],['is_custom', 1]])->pluck('plan')->toArray();
        $plan = Plan::where('status',1)->whereIn('id', $plan_in_product)->get();

        $product = Product::where('status', 1)->get();

        $subplan_in_product = Product::where('status', 1)->pluck('subplan')->toArray();
        $subplan = SubPlan::where('status',1)->whereIn('id', $subplan_in_product)->get();

        $category = Category::where('status',1)->get();
        $menu = Menu::where('status',1)->get();
        return view('add-customplan' , ['customer'=>$customer,'plan'=>$plan,'subplan'=>$subplan , 
        'category'=>$category , 'menu'=>$menu ]);


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
            'plan' => 'required',
            'subplan' => 'required',
            
            'status' => 'required',
            
        ]);

        //  $cat = $request['category'];
        //  $cat_i = implode("," , $cat);
        
        $cat = Product::where([['plan',$request->plan],['subplan' , $request->subplan],['is_custom', 1]])->pluck('category')->toArray();
        $cat_i = implode("," , $cat);
        
        $menu = Product::where([['plan',$request->plan],['subplan' , $request->subplan],['is_custom', 1]])->pluck('menu')->toArray();
        $menu_i = implode("," , $menu);
                

         $custom_plan = new Custom_plan;
         $custom_plan['plan'] = $request['plan'];
         $custom_plan['customer'] = $request['customer'];
         $custom_plan['subplan'] = $request['subplan'];
         $custom_plan['status'] = $request['status'];
         $custom_plan['plan_from'] = $request['plan_from'];
         $custom_plan['plan_to'] = $request['plan_to'];
         $custom_plan['price'] = $request['price'];
         $custom_plan['menu'] = $menu_i;
         $custom_plan['category'] = $cat_i;         
         $custom_plan['plan_type'] = 1;
         $custom_plan->save();

        return redirect()->route('addcustom-plan')
                        ->with('success','Custom Plan created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
