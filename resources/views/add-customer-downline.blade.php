@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            </div>
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> Customer Information</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  <form class="row g-3 needs-validation" novalidate action="{{ route('store-customer-downline',$id)}}" enctype="multipart/form-data" method="POST">
                    
                  @csrf
                  <div class="new-user-info">
                      
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="fname">First Name:</label>
                                 <input type="text" class="form-control" id="fname" placeholder="First Name" name="firstname">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">Last Name:</label>
                                 <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lastname">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add1">Street Address 1:</label>
                                 <input type="text" class="form-control" id="add1" placeholder="Street Address 1" name="streetaddress">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add2">Street Address 2:</label>
                                 <input type="text" class="form-control" id="add2" placeholder="Street Address 2" name="streetaddress1">
                              </div>
                              
                              <div class="form-group col-sm-12">
                                 <label class="form-label">Country:</label>
                                 <select name="country" class="selectpicker form-control" data-style="py-0">
                                    <option>Select Country</option>
                                    <option value="qar">Qatar</option>
                                  
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="mobno">Mobile Number:</label>
                                 <input type="text" class="form-control" id="mobno" placeholder="Mobile Number" name="mobno">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="altconno">Alternate Contact:</label>
                                 <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact" name="alternativemob">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pno">Status:</label>
                                 <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Status</option>
                              <option value="0"> In Active</option>
                              <option value="1">Active</option>
                             
                           </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="city">Town/City:</label>
                                 <input type="text" class="form-control" id="city" placeholder="Town/City" name="city">
                              </div>
                           </div>
                           <hr>
                           <h5 class="mb-3">Security</h5>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="uname">Email:</label>
                                 <input type="text" class="form-control" id="uname" placeholder="User Name" name="email">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">Password:</label>
                                 <input type="password" class="form-control" id="pass" placeholder="Password" name="password">
                              </div>
                              <div class="form-group col-md-6">
                              <label for="validationCustom02" class="form-label">Profile Image</label>
                           <input type="file" class="form-control" id="validationCustom02" required name="image">
                          
                           <div class="invalid-feedback">
                              Please select a Image.
                           </div>
                              </div>
                           </div>
                         
                           <button type="submit" class="btn btn-primary">Add New User</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

@endsection
