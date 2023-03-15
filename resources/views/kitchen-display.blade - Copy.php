@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4">
    <?php
   $i=1;
   foreach($custom_plan as $cp){
   $from = date("Y-m-d",strtotime($cp->plan_from));
   $to = date("Y-m-d",strtotime($cp->plan_to));
   $breakfast="";$lunch="";$snacks="";$dinner="";
   $today = date("Y-m-d");
    if (($today >= $from) && ($today <= $to)){
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
                            <h6 class="heading-title mb-2">Customer Name:{{$cp->firstname}} {{$cp->lastname}}</h6>
                          
                        </div>
            <img src="{{ asset('assets/images/order-history/01.png') }}" class="img-fluid rounded-pill avatar-50" alt="">
         </div>
         <div class="d-flex">
                        
                        <div class="ms-4 order-history">
                            <h6 class="mb-2 heading-title fw-bolder">Break Fast:</h6>
                            <p>
                            @foreach($bf_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </p>
                            
                            <h6 class="mb-2 heading-title fw-bolder">Lunch:</h6>
                            <p>
                            @foreach($l_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </p>
                            <h6 class="mb-2 heading-title fw-bolder">Snacks:</h6>
                            <p>
                            @foreach($s_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </p>
                            <h6 class="mb-2 heading-title fw-bolder">Dinner:</h6>
                            <p>
                            @foreach($d_food_names as $bffn)
                            {{$bffn}}&nbsp;&nbsp;
                            @endforeach
                            </p>
                           
                        </div>
                    </div>
         <hr>
         <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                         <form action="{{route('food_submit')}}" method="POST" id="foodSubmit-{{$cp->cpid}}">
                         @csrf
                            <input type="hidden" name="h_customer_plan_id" value="{{$cp->cpid}}">
                            <input type="hidden" name="h_food" value="{{$food}}">
                           @if($cp->cos == 1 )
                            <a  onClick="submit_form({{$cp->cpid}})" class="btn btn-primary rounded">Mark as Ready</a>
                            @elseif($cp->cos == 2)
                             <a  onClick="#" class="btn btn-warning rounded">Ready for Order </a>
                             @else
                             <a  onClick="#" class="btn btn-success rounded">Delivered</a>
                        @endif
                         </form>  
                        </div>
                        
                    </div>
      </div>
   </div>
</div>      

           
            
           
            

          
            
         

            
            
           
            
         
           
            <?php
    }
   }
?>
    <script>
function submit_form(i){
	document.getElementById("foodSubmit-"+i).submit();
}
</script>

    </div>
    
      </div>



      
      
    
@endsection
