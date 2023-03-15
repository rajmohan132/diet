@extends('layouts.app')
@php
$all_orders = App\Models\Order::count();
$pending_orders = App\Models\Order::where('order_status', '1')->count();
$out_for_delivery = App\Models\Order::where('order_status', '2')->count();
$delivered = App\Models\Order::where('order_status', '3')->count();
$assigned_orders = App\Models\Order::where('assign_status', '1')->count();
$customers = App\Models\Customer::where('id')->count();
$company_data = App\Models\CompanySettings::first();
$app_data = App\Models\AppSettings::first();
$count = DB::table('customers')->count();
$sum=App\Models\Custom_plan::sum('price');
$paid=App\Models\Custom_plan::where('paymentstatus',1)->sum('price');
$unpaid=App\Models\Custom_plan::where('paymentstatus',0)->sum('price');
@endphp
@section('content')
<div class="content-inner mt-5 py-0">
<div class="">
   <h2> Dashboard </h2>
   <p>Welcome message. </p>
</div>
<br>
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="row">
         <img src="{{ asset('assets/images/business_analytics.png') }}"style="width: 44px;">
         <h3 style="padding-left: 35px;margin-top: -19px;"> Business Analytics </h3>
         <div class="col-lg-3">
            <div class="cardanu mb-2">
               <div class="card">
                  <div class="card-body">
                     <a href="{{url('pending-order')}}">
                        <div class="d-flex justify-content-between align-items-center">
                           <img src="{{ asset('assets/images/pending.png') }}" style="width: 50px;"/>
                           <div class="text-end">
                              Pending Orders
                              <h2 class="counter">{{$pending_orders}}</h2>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="card">
               <div class="card-body">
                  <a href="{{url('assigned-order')}}">
                     <div class="d-flex justify-content-between align-items-center">
                        <img src="{{ asset('assets/images/confirmed.png') }}" style="width: 50px;"/>
                        <div class="text-end">
                           Assigned  Orders
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
                        <img src="{{ asset('assets/images/out-of-delivery.png') }}" style="width: 50px;"/>
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
                        <img src="{{ asset('assets/images/delivered.png') }}" style="width: 50px;"/>
                        <div class="text-end">
                           Delivered Orders
                           <h2 class="counter">{{$delivered}}</h2>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="cardanu mb-2">
               <div class="card">
                  <div class="card-body">
                     <a href="{{url('customer-add')}}">
                        <div class="d-flex justify-content-between align-items-center">
                           <img src="{{ asset('assets/images/customer.png') }}" style="width: 50px;"/>
                           <div class="text-end">
                              Total Customer
                              <h2 class="counter"> {{ $count }}</h2>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="cardanu mb-2">
               <div class="card">
                  <div class="card-body">
                     <a href="{{url('reports/paid_report')}}">
                        <div class="d-flex justify-content-between align-items-center">
                           <img src="{{ asset('assets/images/collected.png') }}" style="width: 50px;"/>
                           <div class="text-end">
                              Collected Amount
                              <h2 class="counter">{{$paid}}</h2>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="cardanu mb-2">
               <div class="card">
                  <div class="card-body">
                     <a href="{{url('reports/unpaid_report')}}">
                        <div class="d-flex justify-content-between align-items-center">
                           <img src="{{ asset('assets/images/pendings.png') }}" style="width: 50px;"/>
                           <div class="text-end">
                              Pending Amount
                              <h2 class="counter">{{$unpaid}}</h2>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="cardanu mb-2">
               <div class="card">
                  <div class="card-body">
                     <a href="{{url('reports/sales_Report')}}">
                        <div class="d-flex justify-content-between align-items-center">
                           <img src="{{ asset('assets/images/total.png') }}" style="width: 50px;"/>
                           <div class="text-end">
                              Total Sales
                              <h2 class="counter">{{$sum}}</h2>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
<div class="col-lg-12 col-xl-12">
    <div class="card"  data-iq-gsap="onStart"
      data-iq-opacity="0"
      data-iq-position-y="-40"
      data-iq-duration=".6"
      data-iq-delay=".4"
      data-iq-trigger="scroll"
      data-iq-ease="none">
      <div class="card-header">
         <h4 class="card-title">Sales Figures</h4>
     
      </div>
      <div class="card-body"  data-iq-gsap="onStart"
         data-iq-opacity="0"
         data-iq-position-y="-40"
         data-iq-duration=".6"
         data-iq-delay=".6"
         data-iq-trigger="scroll"
         data-iq-ease="none">
         <div id="admin-chart-1" class="admin-chart-1"></div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-4">
      <div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600"  data-iq-gsap="onStart"
         data-iq-opacity="0"
         data-iq-position-y="-40"
         data-iq-duration=".6"
         data-iq-delay="1"
         data-iq-trigger="scroll"
         data-iq-ease="none">
         <div class="card-header border-0 pb-0">
            <div class="header-title">
               <img src="{{ asset('assets/images/top-customers.png') }}"/>
               <h4 class="card-title" style="padding-left: 34px;margin-top: -22px;">Top Customer</h4>
            </div>
         </div>
         <br>
         <div class="card-body py-0">
         @if($customer)
            <div class="row">
            @foreach($customer as $key=>$item)
              
                <div class="col-lg-4">
                
                <img class="bg-soft-primary rounded img-fluid avatar-40 me-3"
                                     onerror="this.src='{{asset('assets/images/common.jpg') }}'"
                                     src="{!! asset("storage/profileimages/".$item->name->image) !!}">
                  <div class="text" style="margin-top: 10px;">
                     <p >{{Str::limit($item->name->firstname, 15)}}  </p>
                     <span class="badge bg-primary" >Orders: {{$item['count']}}</span>
                  </div>
                  <br> 
               </div>
               @endforeach
            
            </div>
            @else
            <h3 class="text-muted" style="margin-left: 66px;">No Top Customers</h3>
            <img class="w-75" src="{{asset('assets/images/no-data.png')}}" alt="" style="margin-left: 66px;">
            @endif
            <br><br>
         </div>
      </div>
   </div>
   <div class="col-lg-4">

   <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between border-0">
               <div class="header-title ">
               <img src="{{ asset('assets/images/most-popular-product.png') }}"/>
               <h4 class="card-title" style="padding-left: 34px;margin-top: -22px;">Top Selling Packages</h4>
               </div>
            </div>
            <div class="card-body p-0">
               <div class="table-responsive">
                  <table id="basic-table" class="table table-striped table-shadow mb-0" role="grid">
                     <thead class="border-0">
                        <tr>
                           <th>Plan Name</th>
                           <th>Sub plan Name</th>
                           <th>Purchase</th>
                          
                        </tr>
                     </thead>
                     <tbody>
                     @if($top_subscrption)
                     @foreach($top_subscrption as $key=>$item)
                        <tr>
                           <td>
                              <div class="d-flex align-items-center">

                              <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                     onerror="this.src='{{asset('assets/images/common.jpg') }}'"
                                     src="{!! asset("storage/planimages/".$item->subname->planimage) !!}">
                                
                                 <h6><span class="badge bg-dark" > {{Str::limit($item->subname->planname, 15)}}</span> </h6>
                              </div>
                           </td>
                           <td>
                           <span class="badge bg-warning" >{{Str::limit($item->splan->splanname, 15)}} </span>
                           </td>
                           <td> <span class="badge bg-success" >Purchase: {{$item['count']}}</span></td>
                           
                        </tr>
                        @endforeach
         
                        @else
            <h3 class="text-muted" style="margin-left: 66px;">No Top Selling Packages</h3>
            <img class="w-75" src="{{asset('assets/images/no-data.png')}}" alt="" style="margin-left: 66px;">
            @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      
   </div>
</div>
   <div class="col-lg-4">
      <div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600"  data-iq-gsap="onStart"
         data-iq-opacity="0"
         data-iq-position-y="-40"
         data-iq-duration=".6"
         data-iq-delay="1"
         data-iq-trigger="scroll"
         data-iq-ease="none">
         <div class="card-header border-0 pb-0">
            <div class="header-title">
               <img src="{{ asset('assets/images/top.png') }}" style="
                  width: 27px;
                  "/>
               <h4 class="card-title" style="padding-left: 34px;margin-top: -22px;">Top Delivery Man</h4>
            </div>
         </div>
         <br>
         <div class="card-body py-0">
         @if(!$top_deliveryman->isEmpty())
         
       
            <div class="row">
            @foreach($top_deliveryman as $key=>$item)
            
                <div class="col-lg-4">
                <img class="avatar rounded-circle avatar-lg"  src="{{ asset('assets/images/driver.png') }}" style="
                     width: 50px;
                     ">
                  <div class="text" style="margin-top: 10px;">
                     <p > {{Str::limit($item->name->name, 15)}} </p>
                     <span class="badge bg-success" >Deliverys: {{$item['count']}}</span>
                  </div>
               </div>
           
            @endforeach
                
            </div>
            @else
            <h3 class="text-muted" style="margin-left: 66px;">No Top Delivery Boys</h3>
            <img class="w-75" src="{{asset('assets/images/no-data.png')}}" alt="" style="margin-left: 66px;">
        </div>

            @endif
            <br><br>
         </div>
      </div>
   </div>
</div>
@include('include.modals')
@endsection

