@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
   <div class="row">

      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Driverwise Report</h4>
               </div>
            </div>
            <br>
            <form action="" method="post">
               @csrf
               <div class="row" style="padding-left: 29px;">
                  <div class="col-4">
                     <input type="date" class="form-control" placeholder="First name" name="from_date">

                  </div>

                  <div class="col-4">
                     <input type="date" class="form-control" placeholder="First name" name="to_date">

                  </div>
                  <div class="col-2">
                     <select class="form-select" id="validationCustom04" name="driver">
                        <option selected="" disabled="" value="">Delivery Boy</option>
                        @foreach($drivers as $driver)
                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                        @endforeach
                     </select>

                  </div>
                  <div class="col-2">
                     <button type="submit" class="btn btn-primary rounded">Search</button>
                     <a href="{{route('driverwise_report')}}"><button type="button" class="btn btn-primary rounded">Reset</button><a>

                  </div>
               </div>
            </form>

            <div class="card-body">

               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Order ID</th>
                           <th>Customer Name</th>
                           <th>Plan Name</th>
                           <th>Calories Plan</th>
                           <th>Items</th>
                           <th>Address</th>
                           <th>Delivery Status</th>
                           <th>Amount</th>
                           <th>Payment Status</th>
                           <th>Order Date</th>
                           <th>Assigned Date</th>
                           <th>Delivery Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($custom_plan as $dta)
                        <tr>
                           <td>{{$dta->cust_plan_id}}</td>
                           <td>{{$dta->firstname}}</td>
                           <td>{{$dta->pname}}</td>
                           <td>{{$dta->splanname}}</td>
                           <td>
                              <?php
                              $f = json_decode($dta->food);
                              $today = date("Y-m-d");
                              foreach ($f as $fj) {
                                 $fj_date  = date("Y-m-d", strtotime($fj->date));
                                 if ($fj_date == $today) {
                                    $breakfast = $fj->breakfast;
                                    $lunch = $fj->lunch;
                                    $dinner = $fj->dinner;
                                    $snacks = $fj->snacks;
                                 }
                              }
                              $breakfast_array = explode(",", $breakfast);
                              $lunch_array = explode(",", $lunch);
                              $dinner_array = explode(",", $dinner);
                              $snacks_array = explode(",", $snacks);

                              $bf_food_names = [];
                              $l_food_names = [];
                              $d_food_names = [];
                              $s_food_names = [];
                              foreach ($breakfast_array as $bfa) {
                                 foreach ($menu as $m) {
                                    if ($bfa == $m->id) {
                                       $bf_food_names[] = $m->menuname;
                                    }
                                 }
                              }
                              foreach ($lunch_array as $bfa) {
                                 foreach ($menu as $m) {
                                    if ($bfa == $m->id) {
                                       $l_food_names[] = $m->menuname;
                                    }
                                 }
                              }
                              foreach ($dinner_array as $bfa) {
                                 foreach ($menu as $m) {
                                    if ($bfa == $m->id) {
                                       $d_food_names[] = $m->menuname;
                                    }
                                 }
                              }
                              foreach ($snacks_array as $bfa) {
                                 foreach ($menu as $m) {
                                    if ($bfa == $m->id) {
                                       $s_food_names[] = $m->menuname;
                                    }
                                 }
                              }
                              ?>
                              Breakfast : 
                              @foreach($bf_food_names as $bffn)
                              {{$bffn}}&nbsp;&nbsp;
                              @endforeach <br>
                              Lunch : 
                              @foreach($l_food_names as $bffn)
                              {{$bffn}}&nbsp;&nbsp;
                              @endforeach <br>
                              Snacks : 
                              @foreach($s_food_names as $bffn)
                              {{$bffn}}&nbsp;&nbsp;
                              @endforeach <br>
                              Dinner : 
                              @foreach($d_food_names as $bffn)
                              {{$bffn}}&nbsp;&nbsp;
                              @endforeach
                           </td>
                           <td>{{$dta->firstname . ' ' . $dta->lastname}}<br>
                              {{$dta->streetaddress}}<br>
                              {{$dta->streetaddress1 .' , '. $dta->country}}<br>
                              {{$dta->mobno .' , '. $dta->alternativemob }}<br>
                           </td>
                           <td>{{$dta->order_status}}</td>
                           <td>{{$dta->price}}</td>
                           <td>@if($dta->paymentstatus == 1) paid @else unpaid @endif</td>
                           <td>{{date('Y-m-d', strtotime($dta->date))}}</td>
                           <td>Assigned_date</td>
                           <td>Delivery_date</td>
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
@endsection