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

class ReportController extends Controller
{
   
    public function order_Report(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','sub_plans.planname','=','plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,plans.planname as pname')
                        ->get();
    
        return view('order_Report',['order'=>$order]);
    }
    public function plan_Report(Request $request)
    {
        return view('plan_Report');
    }

    public function kitchen_Report(Request $request)
    {
        return view('kitchen_Report');
    }
    public function customer_Report(Request $request)
    {
        $customer_plans = Custom_plan::join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','sub_plans.planname','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,plans.planname as pname,customer_plans.created_at as cpdate')
                        ->get();
        return view('customer_Report' , ['customer_plans'=>$customer_plans]);
    }
    public function paused_Report(Request $request)
    {
        return view('paused_Report');
    }

    public function category_Report(Request $request)
    {
        return view('category_Report');
    }
    public function delivery_Report(Request $request)
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
                        
        return view('delivery_Report',['order'=>$order]);
    }
    public function sales_Report(Request $request)
    {
        return view('sales_Report');
    }
    public function food_list(Request $request)
    {
        return view('food_list');
    }

    public function cancled_Report(Request $request)
    {
        return view('cancled_Report');
    }

    public function kitchen_itemwise(Request $request)
    {
        return view('kitchen_itemwise');
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
        return view('daily_Report');
    }

     public function expiring_Report(Request $request)
    {
        return view('expiring_Report');
    }

    public function all_order(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->get();
        $menu = Menu::All();
        // var_dump($order);die();
        return view('all-order',['order'=>$order , "menu"=>$menu]);
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
            $menu = Menu::All();
        return view('pending-order',["order"=>$order,'users'=>$users , "menu"=>$menu]);
    }

    public function assigned_order(Request $request)
    {
                $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid , customers.id as cid')
                        ->where('orders.assign_status','=',1)
                        // ->orwhere('orders.order_status','=',3)
                        ->get();
            $menu = Menu::All();
        return view('assigned-order',['order'=>$order ,"menu"=>$menu ]);
    }
    public function order_assign_driver(Request $request){
        $driver =  $request['driver_id'];
        foreach($request['orders'] as $ord){
        
            $order =  Order::find($ord);
            $order->driver_id = $driver;
            $order->order_status = 2;
            $order->assign_status = 1;
            $order->assign_date = date("Y-m-d H:i:s");
            $order->update();
        }
        return redirect()->route('pending_order')
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
                        ->where('orders.assign_status','=',1)
                        ->where('orders.order_status','=',2)
                        ->get();
                        $menu = Menu::All();
        return view('outofdelivery-order',['order'=>$order , 'menu'=>$menu]);
    }

    public function delivery_view(Request $request)
    {
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid,customers.id as cid')
                        ->where('orders.order_status','=',3)
                        ->where('orders.assign_status','=',1)
                        ->get();
            $menu = Menu::All();
        return view('delivery-view',['order'=>$order , 'menu'=>$menu]);
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
                    $menu = Menu::All();

        $data = "";$i=1;$status="";$assign="";
        foreach($order as $ord){
                        $food = $ord->food;
                        $food_json = json_decode($food);
                        $date = date("Y-m-d",strtotime($ord->date));
                        $breakfast="";$lunch="";$snacks="";$dinner="";
                        foreach($food_json as $fj){
                        $fj_date  = date("Y-m-d",strtotime($fj->date));
                        if($fj_date == $date){
                           $breakfast = $fj->breakfast;
                           $lunch = $fj->lunch;
                           $dinner = $fj->dinner;
                           $snacks = $fj->snacks;
            
                           }
                           } 
        $breakfast_array = explode(",",$breakfast);
        $lunch_array = explode(",",$lunch);
        $dinner_array = explode(",",$dinner);
        $snacks_array = explode(",",$snacks);

        $bf_food_names=[];$l_food_names=[];$d_food_names=[];$s_food_names=[];
        foreach($breakfast_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $bf_food_names[] = $m->menuname;
                }
            }
        }
        foreach($lunch_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $l_food_names[] = $m->menuname;
                }
            }
        }
        foreach($dinner_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $d_food_names[] = $m->menuname;
                }
            }
        }
        foreach($snacks_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $s_food_names[] = $m->menuname;
                }
            }
        }
        $b_f = "";$l_f="";$s_f="";$d_f="";

        foreach($bf_food_names as $bffn){
             $b_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($l_food_names as $bffn){
             $l_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($s_food_names as $bffn){
             $s_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($d_food_names as $bffn){
             $d_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        
        
    
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
        if($ord->assign_status==""){
            $assign .='
                        <span class="badge bg-dark">
                        Not Assigned
                     </span>
            ';
        }
        if($ord->assign_status==1){
            $assign .='
                        <span class="badge bg-success">
                        Assigned
                     </span>
            ';
        }
        $assign_date = "";$del_date="";
        if($ord->assign_date){
        $assign_date = date("d-m-Y",strtotime($ord->assign_date));
        }
        if($ord->delivery_date){
        $del_date = date("d-m-Y",strtotime($ord->delivery_date));
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
                            Breakfast : '.$b_f.'<br>
                            Lunch : '.$l_f.'<br>
                            Snacks : '.$s_f.'<br>
                            Dinner : '.$d_f.'<br>
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
                        </td>
                        <td>
                            '.date("d-m-Y",strtotime($ord->date)).'
                        </td>
                        <td>
                            '.$assign_date.'
                        </td>
                        <td>
                            '.$del_date.'
                        </td>
                        <td>
                            '.$assign.'
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
                           <th>Menu</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Date</th>
                           <th>Assigned Date</th>
                           <th>Delivery Date</th>
                           <th>Assigned Status</th>
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

public function pending_order_filter(Request $request){

    $from = date("Y-m-d",strtotime($request['fromdate']));
    $to = date("Y-m-d",strtotime($request['todate']));    

        $users = User::where('userrole',6)
                        ->where('status',1)
                        ->get();
        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('users','users.id','=','driver_id','left')
                        ->select('*')
                        ->selectRaw('orders.id as oid,customers.id as cid')
                        ->where('orders.date','>=',$from)
                        ->where('orders.date','<=',$to)
                        ->where('orders.order_status','=',1)
                        ->get();
        $menu = Menu::All();

        $data = "";$i=1;$status="";$assign="";$c=1;
           
        foreach($order as $ord){
         $food = $ord->food;
                        $food_json = json_decode($food);
                        $date = date("Y-m-d",strtotime($ord->date));
                        $breakfast="";$lunch="";$snacks="";$dinner="";
                        foreach($food_json as $fj){
                        $fj_date  = date("Y-m-d",strtotime($fj->date));
                        if($fj_date == $date){
                           $breakfast = $fj->breakfast;
                           $lunch = $fj->lunch;
                           $dinner = $fj->dinner;
                           $snacks = $fj->snacks;
            
                           }
                           } 
        $breakfast_array = explode(",",$breakfast);
        $lunch_array = explode(",",$lunch);
        $dinner_array = explode(",",$dinner);
        $snacks_array = explode(",",$snacks);

        $bf_food_names=[];$l_food_names=[];$d_food_names=[];$s_food_names=[];
        foreach($breakfast_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $bf_food_names[] = $m->menuname;
                }
            }
        }
        foreach($lunch_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $l_food_names[] = $m->menuname;
                }
            }
        }
        foreach($dinner_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $d_food_names[] = $m->menuname;
                }
            }
        }
        foreach($snacks_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $s_food_names[] = $m->menuname;
                }
            }
        }
        $b_f = "";$l_f="";$s_f="";$d_f="";

        foreach($bf_food_names as $bffn){
             $b_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($l_food_names as $bffn){
             $l_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($s_food_names as $bffn){
             $s_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($d_food_names as $bffn){
             $d_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
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
                        Assigned
                     </span>
            ';
        }
        if($ord->order_status==3){
            $status .='
                        <span class="badge bg-dark">
                        Delivered
                     </span>
            ';
        }
        $assign_date = "";
        if($ord->assign_date){
        $assign_date = date("d-m-Y",strtotime($ord->assign_date));
        }

        
        $data .='
                    <tr>
                        <td>
                            <input type="checkbox" name="orders[]" value="'. $ord->oid.'" 
                            id="checkItem-'. $c.'">
                        </td>
                        <td>
                            Customer-00'.$ord->cid.'
                        </td>
                        <td>
                            '.$ord->firstname ." " . $ord->lastname.'
                        </td>
                        <td>
                            '.$ord->planname.'
                        </td>
                        <td>
                            Breakfast : '.$b_f.'<br>
                            Lunch : '.$l_f.'<br>
                            Snacks : '.$s_f.'<br>
                            Dinner : '.$d_f.'<br>
                        </td>
                        <td>
                            '.$ord->streetaddress.'
                        </td>
                        <td>
                            '.date("d-m-Y",strtotime($ord->date)).'
                        </td>
                        
                    </tr>
            ';

        }
         echo '
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr>
                          <th>Select  <input type="checkbox" id="checkAll"></th>
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Food</th>
                           <th>Calories Plan</th>
                           <th>Delivery Location</th>
                           <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        '
                        .$data.
                        '
                        </tbody>
                </table>
                  
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
                        ->where('orders.delivery_date','>=',$from)
                        ->where('orders.delivery_date','<=',$to)
                        ->where('orders.assign_status',1)
                        ->get();
        //  var_dump($order);die();
        $data = "";$i=1;$status="";
        foreach($order as $ord){
        
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
                        '.date("d-m-Y",strtotime($ord->date)).'
                        </td>
                        <td>
                        '.date("d-m-Y",strtotime($ord->assign_date)).'
                        </td>
                        <td><span class="badge bg-success">Assigned</span></td>
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
                           <th>Date</th>
                           <th>Assigned Date</th>
                           <th>Status</th>
                                                   
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

public function filter_order_by_date_delivery_view(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));
        
        $order = Order::join('users','users.id','=','orders.driver_id','left')
                        ->join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid')
                        ->where('orders.delivery_date','>=',$from)
                        ->where('orders.delivery_date','<=',$to)
                        ->where('orders.order_status',3)
                        ->get();
        // var_dump($order);die();
        $menu = Menu::All();
        $data = "";$i=1;$status="";$assign="";
        foreach($order as $ord){
        $food = $ord->food;
                        $food_json = json_decode($food);
                        $date = date("Y-m-d",strtotime($ord->date));
                        $breakfast="";$lunch="";$snacks="";$dinner="";
                        foreach($food_json as $fj){
                        $fj_date  = date("Y-m-d",strtotime($fj->date));
                        if($fj_date == $date){
                           $breakfast = $fj->breakfast;
                           $lunch = $fj->lunch;
                           $dinner = $fj->dinner;
                           $snacks = $fj->snacks;
            
                           }
                           } 
        $breakfast_array = explode(",",$breakfast);
        $lunch_array = explode(",",$lunch);
        $dinner_array = explode(",",$dinner);
        $snacks_array = explode(",",$snacks);

        $bf_food_names=[];$l_food_names=[];$d_food_names=[];$s_food_names=[];
        foreach($breakfast_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $bf_food_names[] = $m->menuname;
                }
            }
        }
        foreach($lunch_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $l_food_names[] = $m->menuname;
                }
            }
        }
        foreach($dinner_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $d_food_names[] = $m->menuname;
                }
            }
        }
        foreach($snacks_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $s_food_names[] = $m->menuname;
                }
            }
        }
        $b_f = "";$l_f="";$s_f="";$d_f="";

        foreach($bf_food_names as $bffn){
             $b_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($l_food_names as $bffn){
             $l_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($s_food_names as $bffn){
             $s_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($d_food_names as $bffn){
             $d_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        
        
    
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
        if($ord->assign_status==""){
            $assign .='
                        <span class="badge bg-dark">
                        Not Assigned
                     </span>
            ';
        }
        if($ord->assign_status==1){
            $assign .='
                        <span class="badge bg-success">
                        Assigned
                     </span>
            ';
        }
        $assign_date = "";$del_date="";
        if($ord->assign_date){
        $assign_date = date("d-m-Y",strtotime($ord->assign_date));
        }
        if($ord->delivery_date){
        $del_date = date("d-m-Y",strtotime($ord->delivery_date));
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
                            Breakfast : '.$b_f.'<br>
                            Lunch : '.$l_f.'<br>
                            Snacks : '.$s_f.'<br>
                            Dinner : '.$d_f.'<br>
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
                        </td>
                        <td>
                        '.date("d-m-Y",strtotime($ord->date)).'
                        </td>
                        <td>
                            '.$assign_date.'
                        </td>
                        <td>
                            '.$del_date.'
                        </td>
                        <td>
                            '.$assign.'
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
                           <th>Date</th>
                            <th>Assigned Date</th>
                           <th>Delivery Date</th>
                           <th>Assigned Status</th>
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

    public function filter_order_by_date_report(Request $request){
        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));

        $order = Order::join('users','users.id','=','orders.driver_id','left')
                        ->join('customer_plans','orders.customer_plan_id','=','customer_plans.id','left')
                        ->join('customers','customer_plans.customer','=','customers.id','left')
                        ->join('plans','customer_plans.plan','=','plans.id','left')
                        ->join('sub_plans','sub_plans.planname','=','plans.id','left')
                        ->select('*')
                        ->selectRaw('customers.id as cid,plans.planname as pname')
                        ->whereBetween('date', [$from, $to])
                        ->get();
        
        $data = "";$i=1;$status="";
        foreach($order as $ord){
        if($ord->order_status==1){
            $status ='
                        <span class="badge bg-danger">
                        Active 
                     </span>
            ';
        }
        if($ord->order_status==0){
            $status .='
                        <span class="badge bg-primary">
                        Inactive
                     </span>
            ';
        }
        $date = date("d-m-Y", strtotime($ord->date));
        $date_from = date("d-m-Y", strtotime($ord->plan_from));
        $date_to = date("d-m-Y", strtotime($ord->plan_to));
        $data .='
                    <tr>
                        <td>
                            Customer-00'.$i++.'
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
                           <th>Order-Id</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                           <th>Customer Name</th>
                           <th>Order date</th>
                           <th>Plan Start Date</th>
                           <th>Plan End Date</th>
                          
                           <th>Order Status</th>
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
                        <span class="badge bg-danger">
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

public function filter_order_by_date_outof(Request $request){

        $from = date("Y-m-d",strtotime($request['fromdate']));
        $to = date("Y-m-d",strtotime($request['todate']));

        $order = Order::join('customer_plans','orders.customer_plan_id','=','customer_plans.id')
                        ->join('customers','customer_plans.customer','=','customers.id')
                        ->join('plans','customer_plans.plan','=','plans.id')
                        ->join('users','users.id','=','driver_id')
                        ->select('*')
                        ->selectRaw('orders.id as oid , customers.id as cid')
                        ->where('orders.assign_status','=',1)
                        ->where('orders.order_status','=',2)
                        ->where('orders.delivery_date','>=',$from)
                        ->where('orders.delivery_date','<=',$to)

                        ->get();
        $menu = Menu::All();
        $data = "";$i=1;$status="";$assign="";
        foreach($order as $ord){
                        $food = $ord->food;
                        $food_json = json_decode($food);
                        $date = date("Y-m-d",strtotime($ord->date));
                        $breakfast="";$lunch="";$snacks="";$dinner="";
                        foreach($food_json as $fj){
                        $fj_date  = date("Y-m-d",strtotime($fj->date));
                        if($fj_date == $date){
                           $breakfast = $fj->breakfast;
                           $lunch = $fj->lunch;
                           $dinner = $fj->dinner;
                           $snacks = $fj->snacks;
            
                           }
                           } 
        $breakfast_array = explode(",",$breakfast);
        $lunch_array = explode(",",$lunch);
        $dinner_array = explode(",",$dinner);
        $snacks_array = explode(",",$snacks);

        $bf_food_names=[];$l_food_names=[];$d_food_names=[];$s_food_names=[];
        foreach($breakfast_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $bf_food_names[] = $m->menuname;
                }
            }
        }
        foreach($lunch_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $l_food_names[] = $m->menuname;
                }
            }
        }
        foreach($dinner_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $d_food_names[] = $m->menuname;
                }
            }
        }
        foreach($snacks_array as $bfa){
            foreach($menu as $m){
                if($bfa == $m->id){
                    $s_food_names[] = $m->menuname;
                }
            }
        }
        $b_f = "";$l_f="";$s_f="";$d_f="";

        foreach($bf_food_names as $bffn){
             $b_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($l_food_names as $bffn){
             $l_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($s_food_names as $bffn){
             $s_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        foreach($d_food_names as $bffn){
             $d_f .= '
                    '.$bffn.'&nbsp;&nbsp;&nbsp;
             ';
        }
        
        
    
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
        if($ord->assign_status==""){
            $assign .='
                        <span class="badge bg-dark">
                        Not Assigned
                     </span>
            ';
        }
        if($ord->assign_status==1){
            $assign .='
                        <span class="badge bg-success">
                        Assigned
                     </span>
            ';
        }
        $assign_date = "";$del_date="";
        if($ord->assign_date){
        $assign_date = date("d-m-Y",strtotime($ord->assign_date));
        }
        if($ord->delivery_date){
        $del_date = date("d-m-Y",strtotime($ord->delivery_date));
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
                            Breakfast : '.$b_f.'<br>
                            Lunch : '.$l_f.'<br>
                            Snacks : '.$s_f.'<br>
                            Dinner : '.$d_f.'<br>
                        </td>
                        <td>
                            '.$ord->name.'
                        </td>
                        <td>
                            '.$ord->streetaddress.'
                        </td>
                        <td>
                            '.date("d-m-Y",strtotime($ord->date)).'
                        </td>
                        <td>
                            '.$assign_date.'
                        </td>
                        <td>
                            '.$del_date.'
                        </td>
                        <td>
                            '.$assign.'
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
                           <th>Menu</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Date</th>
                           <th>Assigned Date</th>
                           <th>Delivery Date</th>
                           <th>Assigned Status</th>
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
