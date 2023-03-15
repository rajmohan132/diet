<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Plan;
use App\Models\SubPlan;
use App\Models\Order;
use App\Models\User;
use App\Models\Custom_plan;

class ReportController extends Controller
{

    public function allorder_report(Request $request)
    {
        
        return view('reports.allorder_report');
    }
    public function pending_report(Request $request)
    {
        
        return view('reports.pending_report');
    }

    public function assigned_report(Request $request)
    {
        
        return view('reports.assigned_report');
    }
    public function out_of_delivery_report(Request $request)
    {
        
        return view('reports.out_of_delivery_report');
    }
    public function delivery_report(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','customer_plans.subplan','=','sub_plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,orders.id as oid,plans.planname as pname')
                        ->where('orders.order_status',3)
                        ->get();
                              
   
        
        return view('reports.delivery_report',['order'=>$order]);
    }
    public function driverwise_report(Request $request)
    {

        $drivers = User::where('userrole',6)
                        ->where('status',1)
                        ->get();

        $query = Order::join('customer_plans', 'orders.customer_plan_id', '=', 'customer_plans.id')
            ->join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*','customer_plans.id as cust_plan_id')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('orders.date', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('orders.date', '<=', $request->to_date);
        }
        if($request->has('driver') && $request->driver){
            $query->where('orders.driver_id', $request->driver);
        } 
        $custom_plan = $query->get();

        $order = Order::All();
        $menu = Menu::All();      

        // dd($custom_plan);
        return view('reports.driverwise_report', ['custom_plan' => $custom_plan, 'drivers' => $drivers,'menu'=>$menu]);
    }
    public function areawise_report(Request $request)
    {
        
        return view('reports.areawise_report');
    }
    public function paid_report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->where('customer_plans.paymentstatus', 1)
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.paid_report', ['custom_plan' => $custom_plan]);
    }
    public function unpaid_report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->where('customer_plans.paymentstatus', 0)
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.unpaid_report', ['custom_plan' => $custom_plan]);
    }
    public function sales_Report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.sales_report', ['custom_plan' => $custom_plan]);
    }
    public function subcrption_report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.subcrption_report', ['custom_plan' => $custom_plan]);
    }
    public function customplan_report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->where('customer_plans.plan_type', 1)
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.customplan_report', ['custom_plan' => $custom_plan]);
    }
    public function normalplan_report(Request $request)
    {
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->where('customer_plans.plan_type', 0)
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.created_at', '<=', $request->to_date);
        }
        $custom_plan = $query->get();
        return view('reports.normalplan_report', ['custom_plan' => $custom_plan]);
    }
    public function paused_Report(Request $request)
    {
        return view('reports.paused_Report');
    }
    public function cancled_Report(Request $request)
    {
        return view('reports.cancled_Report');
    }

    public function expiring_Report(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $dte = Carbon::now()->addDay(3)->toDateString();
        $custom_plan = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->orderBy('cid', 'DESC')
            ->where('customer_plans.plan_to', '>=', $now)
            ->where('customer_plans.plan_to', '<=', $dte)
            ->get();
        return view('reports.expiring_Report', ['custom_plan' => $custom_plan]);
    }
    public function expired_report(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $query = Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->orderBy('cid', 'DESC');
        if ($request->has('from_date') && $request->from_date != null) {
            $query->where('customer_plans.plan_to', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != null) {
            $query->where('customer_plans.plan_to', '<=', $request->to_date);
        } else {
            $query->where('customer_plans.plan_to', '<', $now);
        }

        $custom_plan = $query->get();
        return view('reports.expired_report', ['custom_plan' => $custom_plan, 'now' => $now]);
    }
    public function plan_Report(Request $request)
    {
        return view('plan_Report');
    }

    
    public function customer_report(Request $request)
    {
        $customer_plans = Custom_plan::join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','sub_plans.planname','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,plans.planname as pname,customer_plans.created_at as cpdate')
                        ->get();
        return view('reports.customer_report' , ['customer_plans'=>$customer_plans]);
   
    }

    public function customer_depandreport(Request $request)
    {
        return view('reports.customer_depandreport');
    }
    

    

    public function kitchen_Report(Request $request)
    {
        return view('reports.kitchen_Report');
    }
    public function kitchen_itemwise(Request $request)
    {
        return view('reports.kitchen_itemwise');
    }

    
    public function meals_Report(Request $request)
    {
        return view('meals_Report');
    }
    
    public function itemmeals_Report(Request $request)
    {
        return view('itemmeals_Report');
    }

    public function daily_Report(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('d-m-Y');
        // dd($now);

        $customer_plans = Custom_plan::where('status', 1)->get();
        $category = Category::All();
        $menu = Menu::All();


        $mnu_arr = [];
        $i = 0;
        foreach ($customer_plans as $key => $cst_plan) {
            $mnu_arr[$i] = json_decode($cst_plan->menu, true);
            $i++;
        }
        $count = count($mnu_arr);


        $m_arr = [];
        $k = 0;
        for ($j = 0; $j < $count; $j++) {
            foreach ($mnu_arr[$j] as $dt) {
                $m_arr[] = $dt;
                $k++;
            }
        }
        // dd($m_arr);


        $tdy_arr = [];
        $n = 0;
        foreach ($m_arr as $tdy) {
            if ($tdy['date'] == $now) {
                $tdy_arr['date'][] = $tdy['date'];
                $tdy_arr['breakfast'][] = $tdy['breakfast'];
                $tdy_arr['lunch'][] = $tdy['lunch'];
                $tdy_arr['snacks'][] = $tdy['snacks'];
                $tdy_arr['dinner'][] = $tdy['dinner'];
            }
            $n++;
        }
        $cnt = count($tdy_arr);

        // dd(array($tdy_arr['snacks'][0]));
        $result = call_user_func_array('array_merge', $tdy_arr['snacks']);
        

        $data = [];
        $m = 0;
        for($i = 0; $i < $cnt; $i++){
            foreach($tdy_arr as $td){
                $data['data'] = $td[$i];
                $m++;        
            }
        }

        dd($data);

        // $data = [];
        // $m = 0;
        // for($i = 0; $i < $cnt; $i++){
        //     foreach($tdy_arr[$i] as $td){
        //         dd($td->date);
        //         $data[]['data'] = $td;
        //         $m++;        
        //     }
        // }
        // dd($data);
        return view('reports.daily_Report');
    }
    public function filter_order_by_date_customer(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));
        $customer_plans = Custom_plan::join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','sub_plans.planname','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,plans.planname as pname,customer_plans.created_at as cpdate')
                        // ->whereBetween('customer_plans.created_at', [$from, $to])
                        ->where('customer_plans.created_at','>=',$from)
                        ->where('customer_plans.created_at','<=',$to)
                        ->get();
        
        $data = "";$i=1;$status="";
        foreach($customer_plans as $ord){
        if($ord->status==1){
            $status ='
                        <span class="badge bg-success">
                        Active 
                     </span>
            ';
        }
        if($ord->status==2){
            $status .='
                        <span class="badge bg-primary">
                        Inactive
                     </span>
            ';
        }
        $date = date("d-m-Y", strtotime($ord->cpdate));
        $date_from = date("d-m-Y", strtotime($ord->plan_from));
        $date_to = date("d-m-Y", strtotime($ord->plan_to));
        $data .='
                    <tr>
                        <td>
                            Customer-00'.$ord->cid.'
                        </td>
                        <td>
                            '.$ord->firstname." ".$ord->lastname.'
                        </td>
                        <td>
                            '.$ord->pname.'
                        </td>
                        <td>
                            '.$ord->splanname.'
                        </td>
                        
                        <td>
                            '.$date.'
                        </td>
                        <td>
                            '.$date_from.'
                        </td>
                        <td>
                            '.$date_to.'
                        </td>
                        <td>
                            '.$status.'
                        </td>
                    </tr>
            ';

        }
         echo '
                    <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                           <th>Customer-Id</th>
                           <th>Customer Name</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                           <th>Date</th>
                           <th>Order date</th>
                           <th>Order End Date</th>
                           <th> Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        '
                        .$data.
                        '
                        </tbody>
                </table>
                </div>
                </div>    
                ';
    }

    public function filter_order_by_date_del(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));
         $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','customer_plans.subplan','=','sub_plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,orders.id as oid,plans.planname as pname')
                        ->where('orders.date','>=',$from)
                        ->where('orders.date','<=',$to)
                        ->where('orders.order_status',3)
                        ->get();
        
        $data = "";$i=1;$status="";
        foreach($customer_plans as $ord){
        
        $date = date("d-m-Y", strtotime($ord->date));
        $date_from = date("d-m-Y", strtotime($ord->plan_from));
        $date_to = date("d-m-Y", strtotime($ord->plan_to));
        $data .='
                    <tr>
                        <td>
                            '.$ord->oid.'
                        </td>
                        <td>
                            '.$ord->pname.'
                        </td>
                        <td>
                            '.$ord->splanname.'
                        </td>
                        <td>
                            '.$ord->firstname." ".$ord->lastname.'
                        </td>
                        
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
                        </td>
                        <td>
                            '.$date.'
                        </td>
                        
                    </tr>
            ';

        }
         echo '
                    <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                           <th>Order-Id</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                           <th>Customer Name</th>
                           <th>Delivered by</th>
                           <th>Delivery Area</th>
                            </tr>
                        </thead>
                        <tbody>
                        '
                        .$data.
                        '
                        </tbody>
                </table>
                </div>
                </div>    
                ';
    }

     

}