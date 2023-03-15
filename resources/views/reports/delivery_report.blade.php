@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Delivery Report</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-3">
            <input type="date"  id="from_date_del" class="form-control" placeholder="First name">

            </div>

            <div class="col-3">
            <input type="date" id="to_date_del" class="form-control" placeholder="First name">

            </div>
            
            <div class="col-2">
             <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Delivery Boy</option>
                              <option value="0"> Shearain</option>
                              <option value="1">Anu</option>
                              <option value="0"> Jalal</option>
                              <option value="1">Jaseel</option>
                             
                           </select>

            </div>
            
            <div class="col-2">
             <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Deleivery Area</option>
                              <option value="0"> Al khor</option>
                              <option value="1">Doha</option>
                              <option value="0"> Al Sadd</option>
                              <option value="1">Bin Omran</option>
                             
                           </select>

            </div>
            <div class="col-2">
            <button onclick="date_filter_del()" class="btn btn-primary rounded">Search</button>

            </div>
</div>
            <div id="filter_del"></div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped nofilter_del" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Order-Id</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                           <th>Customer Name</th>
                           <th>Delivered by</th>
                                <th>Delivery Area</th>
                           <th>Date</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($order as $ord)
                        <tr>
                           <td>{{$ord->oid}}</td>
                           <td>{{$ord->pname}}</td>
                           <td>{{$ord->splanname}}</td>
                           <td>{{$ord->firstname}}  {{$ord->lastname}} </td>
                           <td>{{$ord->name}}</td>
                              <td>{{$ord->streetaddress}}</td>
                           <td>{{date("d-m-Y", strtotime($ord->date))}}</td>
                           
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
function date_filter_del(){
   var fromDate = $("#date_from_del").val();
   var toDate = $("#date_to_del").val();

   $.ajax({
            url:"{{route('filter_order_by_date_del')}}",
            method:'POST',
            data:{fromdate:fromDate,todate:toDate, "_token":"{{csrf_token()}}" },
            //dataType:'JSON',
            success:function(res){
               $(".nofilter_del").hide();
               console.log(res);
               $("#filter_del").html(res);
                              
               }
   })
}
</script>


@endsection
