@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Customer Report</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-5">
            <input type="date" id="date_from_customer" class="form-control" placeholder="First name">

            </div>

            <div class="col-5">
            <input type="date" id="date_to_customer" class="form-control" placeholder="First name">

            </div>
            <div class="col-2">
            <button onclick="date_filter_customer()" class="btn btn-primary rounded">Search</button>

            </div>
</div>
            <div id="filter_customer"></div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped nofilter_customer" data-toggle="data-table">
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
                     @foreach($customer_plans as $cp)
                        <tr>
                           <td>Customer-00{{$cp->cid}}</td>
                           <td>{{$cp->firstname}}  {{$cp->lastname}}</td>
                           <td>{{$cp->pname}}</td>
                           <td>{{$cp->splanname}}</td>
                           <td>{{date("d-m-Y", strtotime($cp->cpdate) )}}</td>
                           <td>{{date("d-m-Y", strtotime($cp->plan_from) )}}</td>
                           <td>{{date("d-m-Y", strtotime($cp->plan_to) )}}</td>
                         
                           <td><span class="badge bg-primary">Active</span></td>
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
function date_filter_customer(){
   var fromDate = $("#date_from_customer").val();
   var toDate = $("#date_to_customer").val();

   $.ajax({
            url:"{{route('filter_order_by_date_customer')}}",
            method:'POST',
            data:{fromdate:fromDate,todate:toDate, "_token":"{{csrf_token()}}" },
            //dataType:'JSON',
            success:function(res){
               $(".nofilter_customer").hide();
               console.log(res);
               $("#filter_customer").html(res);
                              
               }
   })
}
</script>


@endsection
