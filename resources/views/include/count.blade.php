



@php
$all_orders = App\Models\Order::count();
$pending_orders = App\Models\Order::where('order_status', '1')->count();
$out_for_delivery = App\Models\Order::where('order_status', '2')->count();
$delivered = App\Models\Order::where('order_status', '2')->count();
$assigned_orders = App\Models\Order::where('assign_status', '1')->count();
$customers = App\Models\Customer::where('id')->count();
$company_data = App\Models\CompanySettings::first();
$app_data = App\Models\AppSettings::first();
$count = DB::table('customers')->count();
@endphp

<h1>{{$count}}</h1>

<div class="cardanu mb-2">
            <div class="card">
            <div class="card-body">
               <a href="{{url('pending-order')}}">
               <div class="d-flex justify-content-between align-items-center">
               <img src="{{ asset('assets/images/pending.png') }}" style="width: 38px;"/>
                  <div class="text-end">
                  Pending Orders
                        <h2 class="counter">{{$pending_orders}}</h2>
                  </div>
               </div>
               </a>
            </div>
         </div>
        </div>