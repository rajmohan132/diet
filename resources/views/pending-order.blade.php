@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Pending Order</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-4">
            <input type="date" id="date_from_pending" class="form-control" placeholder="First name">

            </div>

            <div class="col-4">
            <input type="date" id="date_to_pending" class="form-control" placeholder="First name">

            </div>
            
          
            <div class="col-2">
            <button onclick="date_filter_pending()" class="btn btn-primary rounded">Search</button>

            </div>
            

            <div class="col-2">
            <button  class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Assign</button>

            </div>
          
</div>
            
            
            
            <div class="card-body">
              <div class="table-responsive">
               <form action="{{route('order_assign')}}" method="post" id="order-assign">
               @csrf
               <input type="hidden" name="driver_id" id="driver_id" value="">
               <div id="filter_pending"></div>
                  <table id="datatable" class="table table-striped nofilter_pending" data-toggle="data-table">
                     <thead>
                        <tr>
                        
                           <th>Select  <input type="checkbox" id="checkAll"></th>
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Menu</th>
                           <th>Delivery Location</th>
                           <th>Date</th>
                         
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                     $c=1;$i=1;
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
                        <td><input type="checkbox" name="orders[]" value="{{$ord->oid}}" id="checkItem-{{$c}}"></td>
                           <td>Customer-00{{$ord->cid}}</td>
                           <td>{{$ord->firstname}}  {{$ord->lastname}}</td>
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
                           <td>{{$ord->streetaddress}}</td>
                           <td>{{date("d-m-Y", strtotime($ord->date))}}</td>
                        </tr>
                     @endforeach
                        
                        
                     </tbody>
                     
                  </table>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Choose Drivers</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
               <div class="modal-body">
           <div class="card">
               
                <div class="card-body">
               
                    <form>
                        <div class="row">
                            @foreach($users as $driver)
                              <div class="col-3" style="padding:10px">

                              <button type="button" onclick="pass_driver_id({{$driver->id}})" class="btn btn-success">{{$driver->name}}</button>
                              </div>
                            @endforeach
                          
                       
                        </div>
                    </form>
                </div>
            </div>
               </div>
               <div class="modal-footer">
                
                  <button type="button" onclick="submit_form()" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Submit</button>
               </div>
            </div>
         </div>
      </div>

<script>
   function pass_driver_id(id){
      $("#driver_id").val(id);
      
   }

   function submit_form(){
      var d = $("#driver_id").val();
      $("#order-assign").submit();
   }
</script>  

<script>
function date_filter_pending(){
   var fromDate = $("#date_from_pending").val();
   var toDate = $("#date_to_pending").val();

   $.ajax({
            url:"{{route('pending_order_filter')}}",
            method:'POST',
            data:{fromdate:fromDate,todate:toDate, "_token":"{{csrf_token()}}" },
            //dataType:'JSON',
            success:function(res){
               $(".nofilter_pending").hide();
               console.log(res);
               $("#filter_pending").html(res);
                              
               }
   })
}
</script>



@endsection
