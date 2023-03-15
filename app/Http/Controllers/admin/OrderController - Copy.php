<?php

namespace App\Http\Controllers\admin;

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

class OrderController extends Controller
{
   
    public function all_order(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->get();
        // var_dump($order);die();
        return view('all-order',['order'=>$order]);
    }

    public function pending_order(Request $request)
    {
        $users = User::where('userrole',6)
                        ->where('status',1)
                        ->get();
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('orders.id as oid,customers.id as cid')
                        ->where('orders.order_status','=',1)
                        ->get();
        return view('pending-order',["order"=>$order,'users'=>$users]);
    }

    public function assigned_order(Request $request)
    {
                $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid , customers.id as cid')
                        ->where('orders.order_status','=',2)
                        ->get();
        return view('assigned-order',['order'=>$order]);
    }
    public function order_assign_driver(Request $request){
        $driver =  $request['driver_id'];
        foreach($request['orders'] as $ord){
        
            $order =  Order::find($ord);
            $order->driver_id = $driver;
            $order->order_status = 2;
            $order->update();
        }
        return redirect()->route('pending-order')
                        ->with('success','Food assigned successfully.');

    }

    public function outofdelivery_order(Request $request)
    {
         $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid , customers.id as cid')
                        ->where('orders.order_status','=',2)
                        ->get();
        return view('outofdelivery-order',['order'=>$order]);
    }

    public function delivery_view(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid')
                        ->where('orders.order_status','=',2)
                        ->get();
        return view('delivery-view',['order'=>$order]);
    }

    public function add_customplan(Request $request)
    {
        $customer = Customer::where('status',1)->get();
        $plan = Plan::where('status',1)->get();
        $subplan = subPlan::where('status',1)->get();
        $category = Category::where('status',1)->get();
        $menu = Menu::where('status',1)->get();
        return view('add-customplan' , ['customer'=>$customer,'plan'=>$plan,'subplan'=>$subplan , 'category'=>$category , 'menu'=>$menu ]);
    }

    public function filter_order_by_date(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));

        $order = Order::join('users','users.id','=','orders.driver_id','left')
                        ->join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->whereBetween('date', [$from, $to])
                        ->get();
        
        $data = "";$i=1;$status="";
       
        foreach($order as $ord){
            $status=null;
        if($ord->order_status==1){
            $status ='
                        <span class="badge bg-danger">
                        Pending 
                     </span>
            ';
        }
        if($ord->order_status==2){
            $status .='
                        <span class="badge bg-dark">
                        Out Of Delivery
                     </span>
            ';
        }
        if($ord->order_status==3){
            $status .='
                        <span class="badge bg-success">
                       Delivered
                     </span>
            ';
        }
        $data .='
                    <tr>
                        <td>
                            Customer-00'.$ord->cid.'
                        </td>
                        <td>
                            '.$ord->firstname." ".$ord->lastname.'
                        </td>
                        <td>
                            '.$ord->planname.'
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
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
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Delivery Status</th>
                                                   
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

public function filter_order_by_date_assigned(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));
        
        $order = Order::join('users','users.id','=','orders.driver_id','left')
                        ->join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->whereBetween('date', [$from, $to])
                        ->where('orders.order_status',2)
                        ->get();
        //dd($order);
        $data = "";$i=1;$status="";
        foreach($order as $ord){
            $status=null;
        if($ord->order_status==1){
            $status ='
                        <span class="badge bg-danger">
                        Pending 
                     </span>
            ';
        }
        if($ord->order_status==2){
            $status .='
                        <span class="badge bg-primary">
                        Out Of Delivery
                     </span>
            ';
        }
        if($ord->order_status==3){
            $status .='
                        <span class="badge bg-success">
                        Delivred
                     </span>
            ';
        }
        $data .='
                    <tr>
                        <td>
                            Customer-00'.$ord->cid.'
                        </td>
                        <td>
                            '.$ord->firstname." ".$ord->lastname.'
                        </td>
                        <td>
                            '.$ord->planname.'
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
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
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Delivery Status</th>
                                                   
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


    public function filter_order_by_date_delivred(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));
        
        $order = Order::join('users','users.id','=','orders.driver_id','left')
                        ->join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->whereBetween('date', [$from, $to])
                        ->where('orders.order_status',3)
                        ->get();
        //dd($order);
        $data = "";$i=1;$status="";
        foreach($order as $ord){
            $status=null;
        if($ord->order_status==1){
            $status ='
                        <span class="badge bg-danger">
                        Pending 
                     </span>
            ';
        }
        if($ord->order_status==2){
            $status .='
                        <span class="badge bg-primary">
                        Out Of Delivery
                     </span>
            ';
        }
        if($ord->order_status==3){
            $status .='
                        <span class="badge bg-success">
                        Delivered
                     </span>
            ';
        }
        $data .='
                    <tr>
                        <td>
                            Customer-00'.$ord->cid.'
                        </td>
                        <td>
                            '.$ord->firstname." ".$ord->lastname.'
                        </td>
                        <td>
                            '.$ord->planname.'
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
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
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Delivery Status</th>
                                                   
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

