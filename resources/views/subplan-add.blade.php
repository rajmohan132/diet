@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">SubPlan Creation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('subplan.store') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                     <div class="col-md-12">
                           <label for="validationCustom01" class="form-label">Sub Plan Code</label>
                           <input type="text" value={{$subplancode}} readonly class="form-control" id="validationCustom01" required name="subplancode">
                           <div class="invalid-feedback">
                              Please Enter Plan Code
                           </div>
                        </div>
                        
                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Sub plan Name</label>
                           <input type="text" class="form-control" id="validationCustom02" required name="splanname">
                           <div class="invalid-feedback">
                              Please Enter plan name
                           </div>
                        </div>

                        
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Plan</label>
                           <select class="form-select" id="validationCustom04" required name="planname">
                           <option selected disabled value="">Select plan</option>
                        @foreach($plan as $plans)
                              
                              <option value="{{$plans->id}}">{{$plans->planname}}</option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback">
                              Please select a valid plan.
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Price</label>
                           <input type="text"  class="form-control" id="validationCustom02" required name="price">
                           <div class="invalid-feedback">
                              Please Enter price
                           </div>
                        </div>

                        <!-- <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Category</label>
                           <select class="form-select" id="validationCustom04" required name="status">
                           <option selected disabled value="">Select plan</option>
                        @foreach($plan as $plans)
                              
                              <option value="{{$plans->id}}">{{$plans->planname}}</option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div> -->

                        <!-- <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Menu</label>
                           <select class="form-select" id="validationCustom04" required name="status">
                           <option selected disabled value="">Select plan</option>
                        @foreach($plan as $plans)
                              
                              <option value="{{$plans->id}}">{{$plans->planname}}</option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>
 -->

<!-- 
                        

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Sub Plan Details</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="planmessage"></textarea>
                          
                           <div class="invalid-feedback">
                              Please select a Image.
                           </div>
                        </div> -->

                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Status</label>
                           <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Status</option>
                              <option value="0"> In Active</option>
                              <option value="1">Active</option>
                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>
                        
                        
                        <div class="col-12">
                           <button class="btn btn-primary rounded" type="submit"> Submit </button>
                        </div>
                     </form>
                  </div>
               </div>
                
            </div>
         </div>
      </div>
      </div>

@endsection
