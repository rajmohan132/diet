@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
   <div class="row">

      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Expired Date</h4>
               </div>
            </div>
            <br>

            <form action="" method="post">
               @csrf
               <div class="row" style="padding-left: 29px;">
                  <div class="col-5">
                     <input type="date" class="form-control" name="from_date" placeholder="First name">

                  </div>

                  <div class="col-5">
                     <input type="date" class="form-control" name="to_date" placeholder="First name">

                  </div>
                  <div class="col-2">
                     <button type="submit" class="btn btn-primary rounded">Search</button>
                     <a href="{{route('expired_report')}}"><button type="button" class="btn btn-primary rounded">Reset</button><a>

                  </div>
               </div>
            </form>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Customer Name</th>
                           <th>Plan Name</th>
                           <th>Calories Plan</th>
                           <th>Start Date</th>
                           <th>Ending Date</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($custom_plan as $dta)
                        <tr>
                           <td>{{$dta->firstname}}</td>
                           <td>{{$dta->pname}}</td>
                           <td>{{$dta->splanname}}</td>
                           <td>{{$dta->plan_from}}</td>
                           <td>{{$dta->plan_to}}</td>
                           <td>@if($now > $dta->plan_to)   <span class="badge bg-dark">Expired</span>  @else Not Expired @endif</td>
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