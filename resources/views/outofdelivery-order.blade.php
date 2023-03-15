@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Out Delivery Order</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-4">
            <input type="date" id="date_from_delivery" class="form-control" placeholder="First name">

            </div>

            <div class="col-4">
            <input type="date" id="date_to_delivery" class="form-control" placeholder="First name">

            </div>
            
          
            <div class="col-2">
            <button onclick="date_filter_delivery()" class="btn btn-primary rounded">Search</button>

            </div>

            
</div>
            <div id="filter_delivery"></div>
            <div class="card-body">
             
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped nofilterdelivery" data-toggle="data-table">
                     <thead>
                        <tr>
                            
                           <th>Customer Code</th>
                           <th>Customer Name</th>
                           <th>Calories Plan</th>
                           <th>Menu</th>
                           <th>Delivered by</th>
                           <th>Delivery Location</th>
                           <th>Date</th>
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
                           <td>{{$ord->name}}</td>
                          <td>{{$ord->streetaddress}}</td>
                          <td>{{date("d-m-Y", strtotime($ord->date))}}</td>
                          <td>@if($ord->assign_date){{date("d-m-Y",strtotime($ord->assign_date))}} @endif </td>
                     <td>@if($ord->delivery_date){{date("d-m-Y",strtotime($ord->delivery_date))}} @endif </td>
                     <td>
                     @if($ord->assign_status == 1)
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
                            <div class="col">
                            <button type="button" class="btn btn-danger">Driver 1</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 2</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 3</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 4</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 5</button>
                            </div>
                            <br> <br> 
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 6</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 7</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 8</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 9</button>
                            </div>
                            <div class="col">
                         
                             <button type="button" class="btn btn-danger">Driver 10</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
               </div>
               <div class="modal-footer">
                
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Submit</button>
               </div>
            </div>
         </div>
      </div>
<script>
function date_filter_delivery(){
   var fromDate = $("#date_from_delivery").val();
   var toDate = $("#date_to_delivery").val();

   $.ajax({
            url:"{{route('filter_order_by_date_outof')}}",
            method:'POST',
            data:{fromdate:fromDate,todate:toDate, "_token":"{{csrf_token()}}" },
            //dataType:'JSON',
            success:function(res){
               $(".nofilterdelivery").hide();
               console.log(res);
               $("#filter_delivery").html(res);
                              
               }
   })
}
</script>

@endsection
