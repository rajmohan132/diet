<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\KitchenDisplay;
use App\Models\Custom_plan;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use Artisan;


class KitchenDisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Custom_plan = Custom_plan::join('customers','customers.id','=','customer_plans.customer')
                                    ->select('*')
                                    ->selectRaw('customer_plans.id as cpid,customer_plans.ostatus as cos')
                                    ->get();
        $order = Order::All();
        $menu = Menu::All();
        //dd($Custom_plan);
        return view('kitchen-display',['custom_plan'=>$Custom_plan,"menu"=>$menu , 'order'=>$order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kitchen-display');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $order = new Order;
        $order->customer_plan_id = $request['h_customer_plan_id'];
        $order->food = $request['h_food'];
        $order->date = date("Y-m-d");
        $order->order_status = 1;
        $order->save();

        $cpid = $request['h_customer_plan_id'];
        $Custom_plan = Custom_plan::find($cpid);
        $Custom_plan->ostatus = 2;
        $Custom_plan->update();
        return redirect()->route('kitchenDisplay')
                        ->with('success','Food prepared successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitchenDisplay  $kitchenDisplay
     * @return \Illuminate\Http\Response
     */
    public function show(KitchenDisplay $kitchenDisplay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitchenDisplay  $kitchenDisplay
     * @return \Illuminate\Http\Response
     */
    public function edit(KitchenDisplay $kitchenDisplay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KitchenDisplay  $kitchenDisplay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KitchenDisplay $kitchenDisplay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitchenDisplay  $kitchenDisplay
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitchenDisplay $kitchenDisplay)
    {
        //
    }
}
