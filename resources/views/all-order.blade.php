@php
$all_orders = App\Models\Order::count();
$pending_orders = App\Models\Order::where('order_status', '1')->count();
$out_for_delivery = App\Models\Order::where('order_status', '2')->count();
$delivered = App\Models\Order::where('order_status', '2')->count();
$assigned_orders = App\Models\Order::where('assign_status', '1')->count();
$company_data = App\Models\CompanySettings::first();
$app_data = App\Models\AppSettings::first();
@endphp



@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">All Order Report</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-5">
            <input type="date" id="date_from" class="form-control" placeholder="First name">

            </div>

            <div class="col-5">
            <input type="date" id="date_to" class="form-control" placeholder="First name">

            </div>
            
          
            <div class="col-2">
            <button onclick="date_filter()" class="btn btn-primary rounded">Show Data</button>

            </div>

            <div class="col-md-12 col-lg-12">
            <div class="row" style="margin-top: 20px;margin-right: 6px;">
             

            

    <div class="col-lg-3">
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

      <div class="col-lg-3">
            <div class="card">
            <div class="card-body">
               <a href="{{url('assigned-order')}}">
               <div class="d-flex justify-content-between align-items-center">
               <img src="{{ asset('assets/images/confirmed.png') }}" style="width: 38px;"/>
                  <div class="text-end">
                   Assigned Orders
                        <h2 class="counter">{{$assigned_orders}}</h2>
                  </div>
               </div>
               </a>
            </div>
         </div>
      </div>

      <div class="col-lg-3">
            <div class="card">
            <div class="card-body">
               <a href="{{url('outofdelivery-order')}}">
               <div class="d-flex justify-content-between align-items-center">
               <img src="{{ asset('assets/images/out-of-delivery.png') }}" style="width: 38px;"/>
                  <div class="text-end">
                  Out-of-Delivery Orders
                        <h2 class="counter">{{$out_for_delivery}}</h2>
                  </div>
               </div>
               </a>
            </div>
         </div>
      </div>

      <div class="col-lg-3">
            <div class="card">
            <div class="card-body">
               <a href="{{url('delivery-view')}}">
               <div class="d-flex justify-content-between align-items-center">
               <img src="{{ asset('assets/images/delivered.png') }}" style="width: 38px;"/>
                  <div class="text-end">
                   Delivered Orders
                        <h2 class="counter">{{$delivered}}</h2>
                  </div>
               </div>
               </a>
            </div>
         </div>
        </div>

          
</div>
            <div id="filter"></div>
            <div class="card-body">
               <div class="table-responsive">
               <table id="datatable" class="table table-striped nofilter" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Items</th>
                           <th>Deliverd by</th>
                           <th>Delivery Location</th>
                           <th>Order Date</th>
                           <th>Assigned Date</th>
                           <th>Delivery Date</th>
                           <th>Assigned Status</th>
                           <th>Delivery Status</th>
                                                     
                        </tr>
                     </thead>
                     <tbody>
                       
                     <?php
                     $i=1;
                     ?>
                     @foreach($order as $ord)
                     <?php
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

                     ?>
                        <tr>
                        
                     <td>Customer-00{{$ord->cid}}</td>
                     <td>{{$ord->firstname}}  {{$ord->lastname}} </td>
                     <td>{{$ord->planname}}</td>
                     <td>
                        Break Fast:  
                                @foreach($bf_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach<br>
                        Lunch:  
                            @foreach($l_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach <br>
                        Snacks:   
                                @foreach($s_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach<br>
                            Dinner:
                                @foreach($d_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                     </td>
                     <td>{{$ord->name}}</td>
                     <td>{{$ord->streetaddress}}</td>
                     <td>{{date("d-m-Y",strtotime($ord->date))}}</td>
                     <td>@if($ord->assign_date){{date("d-m-Y",strtotime($ord->assign_date))}} @endif </td>
                     <td>@if($ord->delivery_date){{date("d-m-Y",strtotime($ord->delivery_date))}} @endif </td>
                     <td>
                     @if($ord->driver_assign_status==1)
                     <span class="badge bg-success">
                        Assigned 
                     </span>
                     @else
                     <span class="badge bg-dark">
                        Not Assigned 
                     </span>
                     @endif
                     </td>
                     <td>
                     @if($ord->order_status==1)
                     <span class="badge bg-danger">
                        Pending 
                     </span>
                     @elseif($ord->order_status==2)
                     <span class="badge bg-primary">
                        Out Of Delivery
                     </span>   
                     @elseif($ord->order_status==3)   
                     <span class="badge bg-success">
                         Delivered
                     </span> 
                     @else
                      <span class="badge bg-warning">
                         Not Ready
                     </span> 
                     @endif
                     </td>
                     </tr>
                     @endforeach
                                                                 
                     </tbody>
                     
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>
      
<script>
function date_filter(){
   var fromDate = $("#date_from").val();
   var toDate = $("#date_to").val();

   $.ajax({
            url:"{{route('filter_order_by_date')}}",
            method:'POST',
            data:{fromdate:fromDate,todate:toDate, "_token":"{{csrf_token()}}" },
            //dataType:'JSON',
            success:function(res){
               $(".nofilter").hide();
               console.log(res);
               $("#filter").html(res);
                              
               }
   })
}
</script>



@endsection
