@extends('layouts.app')

@section('content')



<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />





<div class="ui container">
  <div class="ui grid">
    <div class="ui sixteen column">
    <input type="hidden" id="day" value="{{$customPlan->plan_from}}">
    <input type="hidden" id="cid" value="{{$customPlan->menu}}">
    <?php
    $json_result = json_encode($food);
    ?>
    <input type="hidden" id="food" value="{{$json_result}}">
      <div id="calendar"></div>
    </div>
  </div>
</div>
    
@endsection

