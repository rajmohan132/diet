<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User_privilege;
use App\Models\Privilage;
use App\Models\Order;
use App\Models\Custom_plan;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    //    dd(1);

    $top_subscrption = Custom_plan::with(['subname','splan'])
    ->select('plan','subplan', DB::raw('COUNT(plan) as count'))
    ->where(['status'=>'1'])
    ->groupBy('plan','subplan')
    ->orderBy("count", 'desc')
    ->take(6)
    ->get();

   //dd($top_subscrption);

       $customer = Custom_plan::with(['name'])
       ->select('customer', DB::raw('COUNT(customer) as count'))
       ->groupBy('customer')
       ->orderBy("count", 'desc')
       ->take(6)
       ->get();
           //dd($customer);

       $top_deliveryman = Order::with(['name'])
            ->select('driver_id', DB::raw('COUNT(driver_id) as count'))
            ->where(['order_status'=>'3'])
            ->whereNotNull('driver_id')
            ->groupBy('driver_id')
            ->orderBy("count", 'desc')
            ->take(6)
            ->get();

        $from = Carbon::now()->startOfYear()->format('Y-m-d');
        $to = Carbon::now()->endOfYear()->format('Y-m-d');
      
        $data['top_deliveryman'] = $top_deliveryman;
        $data['customer'] = $customer;
        $data['top_subscrption'] = $top_subscrption;
  
        DB::table('configs')
            ->where('key', 'lastActivityTime')
            ->update(array('value' => now()));
        DB::table('configs')
            ->where('key', 'lock_status')
            ->update(array('value' => '0'));

        $userrole = Auth::user()->userrole;
        
        // $user_privilage = User_privilege::All(); 
        // var_dump($user_privilage);die();                                   
        
        return view('dashboard',compact('top_deliveryman','customer','top_subscrption'));
    }
}
