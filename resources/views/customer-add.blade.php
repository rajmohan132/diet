@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            <!-- <div class="col-xl-3 col-lg-4">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Upload Photo</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  <form class="row g-3 needs-validation" novalidate action="{{ route('category-add.store') }}" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                           <div class="profile-img-edit position-relative">
                              <img class="profile-pic rounded avatar-100" src="../assets/images/avatars/01.png" alt="profile-pic">
                              <div class="upload-icone bg-primary">
                                 <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                    <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                 </svg>
                                 <input class="file-upload" type="file" accept="image/*">
                              </div>
                           </div>
                           <div class="img-extension mt-3">
                              <div class="d-inline-block align-items-center">
                                 <span>Only</span>
                                 <a href="javascript:void();">.jpg</a>
                                 <a href="javascript:void();">.png</a>
                                 <a href="javascript:void();">.jpeg</a>
                                 <span>allowed</span>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">User Role:</label>
                           <select name="type" class="selectpicker form-control" data-style="py-0">
                              <option>Select</option>
                              <option>Web Designer</option>
                              <option>Web Developer</option>
                              <option>Tester</option>
                              <option>Php Developer</option>
                              <option>Ios Developer </option>
                           </select>
                        </div>
</form>  
                   
                  </div>
               </div> -->
            </div>
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> Customer Information</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  <form class="row g-3 needs-validation" novalidate action="{{ route('customer-add.store') }}" enctype="multipart/form-data" method="POST">
                    
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
