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
            <div class="row" style="padding-left: 29px;">
            <!-- <div class="col-5">
            <input type="date" class="form-control" placeholder="First name">

            </div>

            <div class="col-5">
            <input type="date" class="form-control" placeholder="First name">

            </div>
            <div class="col-2">
            <button type="submit" class="btn btn-primary rounded">Search</button>

            </div> -->
            <br><br>
            <div class="card-body px-0">
               <div class="table-responsive">
               <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                           <tr class="ligth">
                           <th style="font-size: 13px;"> Name</th>
                           <th  style="font-size: 13px;">Plan Name</th>
                           <th  style="font-size: 13px;"> Calories Plan</th>
                           <th  style="font-size: 13px;">Start Date</th>

                           <th  style="font-size: 13px;">End Date </th>

                     
                           <th  style="font-size: 13px;">Plan Type </th>
                           
                           <th  style="font-size: 13px;">Actions</th>
                           <th  style="font-size: 13px;">Price</th>
                           <th  style="font-size: 13px;">Payment Status</th>
                           <th  style="font-size: 13px;">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($custom_plan as $cp)
                           <tr>
                            
                           <?php
                          $days = 0;
                          $days = (int)$cp->num_days;
                          $num_days = $days*7;
                          
                          ?>
                          
                          <td>{{$cp->firstname}}&nbsp;&nbsp;{{$cp->lastname}}</td>
                           <td>{{$cp->pname}}</td>
                           <td>{{$cp->splan}}</td>
                                                    
                           <td>{{date("d-m-Y",strtotime($cp->plan_from))}}</td>
                           <td>{{date("d-m-Y",strtotime($cp->plan_to))}}</td>
                          
                           <input type="hidden" value="{{$cp->plan_from}}" id="from-{{$cp->cid}}">
                           <input type="hidden" value="{{$cp->plan_to}}" id="to-{{$cp->cid}}">
                           <td>
                           @if($cp->plan_type == 1)
                                        <span class="badge bg-danger">Custom Plan</button>
        
  
@elseif($cp->plan_type == '0')
<span class="badge bg-warning">
Normal Plan
</span>

@endif  
                           
                           </td>
                              
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">open</a> -->
                                    
                                    @if($cp->assign_status == 1)  
                                    <button class="btn btn-sm btn-icon btn-warning assign" onclick="pass_modal({{$cp->cid}})"   data-bs-target="#assignFood"  disabled>
                         
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><title>ionicons-v5-l</title><path d="M384,352H184.36l-41,35-41-35H16v24c0,30.59,21.13,55.51,47.26,56,2.43,15.12,8.31,28.78,17.16,39.47C93.51,487.28,112.54,496,134,496H266c21.46,0,40.49-8.72,53.58-24.55,8.85-10.69,14.73-24.35,17.16-39.47,13.88-.25,26.35-7.4,35-18.63A61.26,61.26,0,0,0,384,376Z"/><path d="M105,320h0l38.33,28.19L182,320H384v-8a40.07,40.07,0,0,0-32-39.2c-.82-29.69-13-54.54-35.51-72C295.67,184.56,267.85,176,236,176H164c-68.22,0-114.43,38.77-116,96.8A40.07,40.07,0,0,0,16,312v8h89Z"/><path d="M463.08,96H388.49l8.92-35.66L442,45,432,16,370,36,355.51,96H208v32h18.75l1.86,16H236c39,0,73.66,10.9,100.12,31.52A121.9,121.9,0,0,1,371,218.07a124.16,124.16,0,0,1,10.73,32.65,72,72,0,0,1,27.89,90.9A96,96,0,0,1,416,376c0,22.34-7.6,43.63-21.4,59.95a80,80,0,0,1-31.83,22.95,109.21,109.21,0,0,1-18.53,33c-1.18,1.42-2.39,2.81-3.63,4.15H416c16,0,23-8,25-23l36.4-345H496V96Z"/></svg>

</button>  
@else
<button class="btn btn-sm btn-icon btn-success assign" onclick="pass_modal({{$cp->cid}})"  data-bs-toggle="modal" data-bs-target="#assignFood"    >
                        
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20"><path d="M18 11v7a2 2 0 0 1-4 0v-5h-2V3a3 3 0 0 1 3-3h3v11zM4 10a2 2 0 0 1-2-2V1a1 1 0 0 1 2 0v4h1V1a1 1 0 0 1 2 0v4h1V1a1 1 0 0 1 2 0v7a2 2 0 0 1-2 2v8a2 2 0 0 1-4 0v-8z"/></svg>


</button>  
@endif

                        <button class="btn btn-sm btn-icon btn-dark" @if($cp->assign_status == 0) disabled @endif   >
                           <a href="{{route('food_list',$cp->cid)}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16"> <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/> </svg>
</a>
</button>  

      

      <a class="btn btn-sm btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#" data-id=''>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause" viewBox="0 0 16 16"> <path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"/> </svg>
      </a>  
                                    
                                 </div>
                              </td>
                              <td>
                              {{$cp->price}}
                           
                           </td>
                           <td>
                           @if($cp->paymentstatus == 1)
                                        <span class="badge bg-success">paid</button>
        
  
@elseif($cp->paymentstatus == '0')
<span class="badge bg-danger">
unpaid
</span>


  
@endif  
           
                           
                     
                           
                           </td>

                           <td>
                           <span class="badge bg-primary">Active</span>
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

      
      
      <!-- Modal -->
      

 <!--food list-  -->

 <div class="modal fade bd-example-modal-xl" id="assignFood" tabindex="-1" role="dialog"  aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Food Change</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
               <div class="modal-body">
           <div class="card">
               
                <div class="card-body">
               
                    <form action="{{route('add-bulk-menu')}}" method="POST" >
                    @csrf
                    <div id="result">
                    
                    </div>
                        <!-- <table>
                           <tr>
                              <thead><input type="date" name="current_date"></thead>
                              <thead>
                                 <table>
                                    <tr>
                                       <thead>
                                          <select>
                                             <option value="">--Meal Type--</option>
                                          </select>   
                                       </thead>
                                    </tr>
                                    <tr>
                                       <thead>
                                          <select>
                                             <option value="">--Menu--</option>
                                          </select>   
                                       </thead>
                                    </tr>
                                 </table>
                              </thead>
                           </tr>
                        </table> -->
                    
                </div>
            </div>
               </div>
               <div class="modal-footer">
                
                  <button type="submit" class="btn btn-primary" >Save</button>
               </div>
               </form>
            </div>
         </div>
      </div>


       <!--food list end-  -->

      
      <!-- Modal -->
      

      <!-- Modal components -->
      

@endsection
