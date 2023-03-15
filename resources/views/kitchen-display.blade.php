@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4">
<?php
    $i=1;
?>
@foreach($custom_plan as $cp)  
<?php
   $from = date("Y-m-d",strtotime($cp->plan_from));
   $to = date("Y-m-d",strtotime($cp->plan_to));  
   $today = date("Y-m-d");
   $breakfast="";$lunch="";$snacks="";$dinner="";
    if($today <= $to && $today >= $from){
        $food = $cp->menu;
        $food_json = json_decode($food);
        foreach($food_json as $fj){
            $fj_date  = date("Y-m-d",strtotime($fj->date));
            if($fj_date == $today){
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

<div class="col">
            <div class="card order-history-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div class="">
                            <h6 class="heading-title mb-2">Order : {{$i++}}</h6>
                            <h6 class="heading-title mb-2">Customer Name: {{$cp->firstname}} {{$cp->lastname}} </h6>
                          
                        </div>
                        <img src="{{ asset('assets/images/order-history/01.png') }}" class="img-fluid rounded-pill avatar-50" alt="">
                    </div>
                    <div class="d-flex">
                        
                        <div class="ms-4 order-history">
                            <h6 class="mb-2 heading-title fw-bolder">Break Fast:  
                                @foreach($bf_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </h6>
                                                       
                            <h6 class="mb-2 heading-title fw-bolder">Lunch:  
                            @foreach($l_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </h6>
                            
                            <h6 class="mb-2 heading-title fw-bolder">Snacks:   
                                @foreach($s_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </h6>
                            
                            <h6 class="mb-2 heading-title fw-bolder">Dinner:
                                @foreach($d_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </h6>
                           
                        </div>
                    </div>
                     
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                         <form action="{{route('food_submit')}}" method="POST" id="foodSubmit-{{$cp->cpid}}">
                         @csrf
                            <input type="hidden" name="h_customer_plan_id" value="{{$cp->cpid}}">
                            <input type="hidden" name="h_food" value="{{$food}}">
                            @if($today == date("Y-m-d",strtotime($cp->last_date)))
                          <a  style="text-decoration:none" class="btn btn-dark rounded">Completed</a>
                          @else
                          <a  onClick="submit_form({{$cp->cpid}})" class="btn btn-success rounded">Mark as Ready</a>
                          @endif
                         </form>  
                        </div>
                       
                    </div>
                    
                </div>
           
            </div>  
    
          </div>
<?php
}
?>

@endforeach
            
 </div>
 </div>     

<script>
function submit_form(i){
	document.getElementById("foodSubmit-"+i).submit();
}
</script>

@endsection
