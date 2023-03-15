@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">User Creation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('user-add.store') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                    
                     <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Name</label>
                           <input type="text" class="form-control" id="validationCustom02" required name="name">
                           <div class="invalid-feedback">
                              Please Enter name
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Email</label>
                           <input type="text" class="form-control" id="validationCustom02" required name="email">
                           <div class="invalid-feedback">
                              Please Enter email
                           </div>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">User Password</label>
                           <input type="password" class="form-control" id="validationCustom02" required name="password">
                           <div class="invalid-feedback">
                              Please Enter Password
                           </div>
                        </div>

                        

                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">User Role</label>
                           <select class="form-select" id="validationCustom04" required name="userrole">
                           <option selected disabled value="">Select Userroles</option>
                        @foreach($userrole as $userroles)
                              
                              <option value="{{$userroles->id}}">{{$userroles->rolename}}</option>
                              @endforeach
                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>
                        
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
