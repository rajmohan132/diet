@extends('layouts.app')
@section('content')
<div class="content-inner mt-5 py-0">
      <div class="row">
         <div class="col-lg-12">
            <div class="iq-main">
               <div class="card mb-0 iq-content rounded-bottom">
                  <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
                     <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img22 position-relative me-3 mb-3 mb-lg-0">
                           <img src="../../assets/images/User-profile/1.png" class="img-fluid avatar avatar-100 avatar-rounded" alt="profile-image">
                        </div>
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                           <div>
                              <h6 class="me-2 text-primary">Devon Lane</h6>
                              <span><svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z" stroke="#07143B" stroke-width="1.5"/>
                                 <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5"/>
                                 </svg><small class="mb-0 text-dark">Lisbon, Portugal</small></span>
                           </div>
                           <div class="ms-4">
                              <p class="mb-0 text-dark">UI/UX Designer</p>
                              <p class="me-2 mb-0 text-dark">Hello@gmail.com</p>
                              <p class="mb-0 text-dark">Email</p>
                           </div> 
                        </div>
                     </div>
                     
                  </div>
               </div>
               <div class="iq-header-img">
                  <img src="../../assets/images/User-profile/01.png" alt="header" class="img-fluid w-100 rounded" style="object-fit: contain;">
               </div>
            </div>
         </div>
         
         <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> Profile Information</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  <form action="{{route('update_profile')}}" method="POST" enctype="multipart/form-data" id="">
                                                 @csrf
                  <div class="new-user-info">
                      
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="fname">First Name:</label>
                                 <input type="text" name="name" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="{{Auth::user()->name}}">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">Mobile Number:</label>
                                 <input type="text" class="form-control" name="mobile" id="phonenumberInput" placeholder="Enter your phone number" value="{{Auth::user()->mobile}}" >
                              </div>
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="add1">Email:</label>
                                 <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="{{Auth::user()->email}}" readonly>
                              </div>
                              
                              <div class="form-group col-md-12">
                              <button class="btn btn-success rounded" type="submit">{{__('update')}}</button>
                                                            <button class="btn btn-danger rounded" type="button">{{__('reset')}}</button>
                              </div>
                              
                             
                           </div>
                           </form>
                           <hr>
                           <h5 class="mb-3">Security</h5>
                           <form action="{{route('update_password')}}" method="POST" enctype="multipart/form-data" id="">
                                        @csrf

                                        @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif  
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="uname">Old Password:</label>
                                 <input name="old_password" type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password" required>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">New Password:</label>
                                 <input name="new_password" type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password" required>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">Confirm Password:</label>
                                 <input name="confirm_password" type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" required>
                              </div>
                             
                           </div>
                         
                           <button class="btn btn-success rounded" type="submit">{{__('update')}}</button>
                        <button type="submit" class="btn btn-danger rounded">{{__('reset')}}</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         
         
         </div>
      </div>
      

@endsection
