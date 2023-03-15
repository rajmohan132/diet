@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Plan Updation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('plan-update') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                     <div class="col-md-12">
                           <label for="validationCustom01" class="form-label">Plan Code</label>
                           <input type="text" value="{{$plan->plancode}}"  class="form-control" id="validationCustom01" required name="plancode">
                           <div class="invalid-feedback">
                              Please Enter Plan Code
                           </div>
                        </div>
                        
                        <input type="hidden" name="plan_id" value="{{$plan->id}}">

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Name</label>
                           <input type="text" value="{{$plan->planname}}"  class="form-control" id="validationCustom02" required name="planname">
                           <div class="invalid-feedback">
                              Please Enter plan name
                           </div>
                        </div>

                       

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Num of Days</label>
                           <select name="num_days" class="form-select" id="validationCustom04" required >
                              <option selected disabled value="">Select Status</option>
                              <option value="1" @if($plan->num_days == "1"){{"Selected"}} @endif > 1 week </option>
                              <option value="2" @if($plan->num_days == "2"){{"Selected"}} @endif > 2 weeks</option>
                              <option value="3" @if($plan->num_days == "3"){{"Selected"}} @endif > 3 weeks</option>
                             
                           </select>
                           <div class="invalid-feedback">
                              Please Enter number of days
                           </div>
                        </div>


                        <div class="col-md-12">
                        <label for="validationCustom02" class="form-label"> <img src="{{asset('storage/planimages/'.$plan->planimage)}}" style="height:70px;width:75px"> </label>
                           <label for="validationCustom02" class="form-label">Plan Image</label>
                           <input type="file"  name="planimage" class="form-control" id="validationCustom02"  >
                           <div class="invalid-feedback">
                              Please Enter plan name
                           </div>
                        </div>


                        
                        
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Status</label>
                           <select name="status" class="form-select" id="validationCustom04" required >
                              <option selected disabled value="">Select Status</option>
                              <option value="0" @if($plan->status=="0"){{"selected"}}@endif > In Active</option>
                              <option value="1" @if($plan->status=="1"){{"selected"}}@endif >Active</option>
                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Details</label>
                           <textarea name="planmessage" class="form-control" id="exampleFormControlTextarea1" rows="5" >{{$plan->planmessage}}</textarea>
                          
                           <div class="invalid-feedback">
                              Please select a Image.
                           </div>
                        </div>
                        
                        
                        <div class="col-12">
                           <button class="btn btn-primary rounded" type="submit">Submit </button>
                        </div>
                     </form>
                  </div>
               </div>
                
            </div>
         </div>
      </div>
      </div>

@endsection
