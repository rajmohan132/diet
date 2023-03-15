@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Plan Creation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('plan-add.store') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                     <div class="col-md-12">
                           <label for="validationCustom01" class="form-label">Plan Code</label>
                           <input type="text" value={{$plancode}} readonly class="form-control" id="validationCustom01" required name="plancode">
                           <div class="invalid-feedback">
                              Please Enter Plan Code
                           </div>
                        </div>
                        
                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Name</label>
                           <input type="text"  class="form-control" id="validationCustom02" required name="planname">
                           <div class="invalid-feedback">
                              Please Enter plan name
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Num of Days</label>
                           <select name="num_days" class="form-select" id="validationCustom04" required >
                              <option selected disabled value="">Select number of days</option>
                              <option value="1"> 1 week </option>
                              <option value="2"> 2 weeks</option>
                              <option value="3"> 3 weeks</option>
                             
                           </select>
                           <div class="invalid-feedback">
                              Please Enter number of days
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Image</label>
                           <input type="file" name="planimage" class="form-control" id="validationCustom02" required >
                           <div class="invalid-feedback">
                              Please Enter plan name
                           </div>
                        </div>


                        
                        
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Status</label>
                           <select name="status" class="form-select" id="validationCustom04" required >
                              <option selected disabled value="">Select Status</option>
                              <option value="0"> In Active</option>
                              <option value="1">Active</option>
                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Plan Details</label>
                           <textarea name="planmessage" class="form-control" id="exampleFormControlTextarea1" rows="5" ></textarea>
                          
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
