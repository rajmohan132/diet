@extends('layouts.app')

<style>
   .check {
      display: inline-block;
      margin-right: 10px;
   }
</style>
@section('content')

<div class="content-inner mt-5 py-0">
   <div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">All Subscrption List</h4>
                  </div>
               </div>
               <br><br>
               <form action="" method="post">
                  <div class="row" style="padding-left: 29px;">
                     @csrf
                     <div class="col-5">
                        <input type="date" class="form-control" name="from_date" placeholder="">

                     </div>

                     <div class="col-5">
                        <input type="date" class="form-control" name="to_date" placeholder="">

                     </div>
                     <div class="col-2">
                        <button type="submit" class="btn btn-primary rounded">Search</button>
                        <a href="{{route('subscription_report')}}"><button type="button" class="btn btn-primary rounded">Reset</button><a>

                     </div>
                  </div>
               </form>
               <br><br>
               <div class="card-body px-0">
                  <div class="table-responsive">
                     <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table" style="
    font-size: 13px;
">
                        <thead>
                           <tr class="ligth">
                              <th> Name</th>
                              <th>Plan Name</th>
                              <th>Calories Plan</th>
                              <th>Start Date</th>
                              <th>End Date </th>
                              <th>Total Days </th>
                              <th>Plan Type </th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Payment Status</th>
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
                              <td>{{$dta->num_days}}</td>
                              <td>
                              
                              @if($dta->plan_type == 1)
                                           <span class="badge bg-info">Custom Plan</button>
           
     
   @elseif($dta->plan_type == '0')
   <span class="badge bg-warning">
   Normal Plan
   </span>
   
   @endif  
     
                              
                             </td>
                           <td>{{$dta->price}}</td>
                           <td>
                              
                              @if($dta->status == 1)
                                           <span class="badge bg-primary">Active</span>
           
     
   @elseif($dta->status == '0')
   <span class="badge bg-danger">
   In Active
   </span>
   
   @endif  
                           </td>
                           <td>

                               @if($dta->paymentstatus == 1)
                                        <span class="badge bg-dark">paid</span>
        
  
@elseif($dta->paymentstatus == '0')
<span class="badge bg-danger">
unpaid
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
</div>





@endsection