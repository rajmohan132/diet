@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
        
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> {{__('Company Settings')}}</h4>
                     </div>
                  </div>
                  <div class="card-body">
                 
                  <form id="add_company_settings" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="@isset($company_settings) {{$company_settings->id}} @endisset" name="id">
                 
                  <div class="new-user-info">
                      
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="fname">{{__('Company Name')}}</label>
                                 <input type="text" class="form-control form-control" placeholder="Enter your firstname" name="company_name" id="name" value="@isset($company_settings) {{$company_settings->company_name}} @endisset">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">{{__('Company Logo')}}</label>
                                 <input type="file" name="company_logo" class="form-control form-control" value="@isset($company_settings) {{$company_settings->company_logo}} @endisset"  />
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add1">{{__('Company Address')}}</label>
                                 <input id="tag" name="company_address" class="form-control form-control" value="@isset($company_settings) {{$company_settings->company_address}} @endisset">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add2">{{__('Date Format')}}</label>
                                 <select class="form-control select2" name="date_format">
                                            <option>{{__('Select')}}</option>
                                            <option value="d-m-Y" @isset($company_settings)@if($company_settings->date_format == "dd-mm-yyy") selected @endif @endisset>dd-mm-yyy</option>
                                            <option value="d/m/Y" @isset($company_settings)@if($company_settings->date_format == "dd/mm/yyy") selected @endif @endisset
                                                >dd/mm/yyy</option>
                                            <option value="d.m.Y" @isset($company_settings)@if($company_settings->date_format == "dd.mm.yyy") selected @endif @endisset>dd.mm.yyy</option>
                                            <option value="m-d-Y" @isset($company_settings)@if($company_settings->date_format == ">mm-dd-yyy") selected @endif @endisset>mm-dd-yyy</option>
                                            <option value="m/d/Y" @isset($company_settings)@if($company_settings->date_format == "mm/dd/yyy") selected @endif @endisset>mm/dd/yyy</option>
                                            <option value="m.d.Y" @isset($company_settings)@if($company_settings->date_format == "mm.dd.yyy") selected @endif @endisset>mm.dd.yyy</option>
                                            <option value="Y-m-d" @isset($company_settings)@if($company_settings->date_format == "yyy-mm-dd") selected @endif @endisset>yyy-mm-dd</option>
                                            <option value="Y/m/d" @isset($company_settings)@if($company_settings->date_format == "yyy/mm/dd") selected @endif @endisset>yyy/mm/dd</option>
                                            <option value="Y.m.d" @isset($company_settings)@if($company_settings->date_format == "yyy.mm.dd") selected @endif @endisset>yyy.mm.dd</option>
                                        </select>
                              </div>
                              
                              <div class="form-group col-md-6">
                                 <label class="form-label">{{__('Time Zone')}}</label>
                                 <select class="form-control select2" name="time_zone">
                                            @foreach($zones_array as $zone)
                                            <option value="{{$zone['zone']}}" @isset($company_settings)@if($zone['zone']==$company_settings->time_zone) selected @endif @endisset>{{$zone['diff_from_GMT'] . ' - ' . $zone['zone']}}</option>
                                            @endforeach
                                        </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="mobno">{{__('Side Bar Color')}}</label>
                                 <input type="color" name="primary" value="{{ $company_settings->primary }}" class="form-control ">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="altconno">{{__('Email Id')}}</label>
                                 <input type="email" name="company_email" class="form-control form-control" value="@isset($company_settings) {{$company_settings->company_email}} @endisset" required />
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pno">{{__('Phone Number')}}</label>
                                 <input type="text" name="phone_number" class="form-control form-control" value="@isset($company_settings) {{$company_settings->phone_number}} @endisset" required />
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="city">{{__('Fav Icon')}}</label>
                                 <input type="file" name="fav_icon" class="form-control form-control" value=""  />
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="form-label" for="uname">{{__('Login Image')}}</label>
                                 <input type="file" name="login_image" class="form-control form-control" value="" required />
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">{{__('Country')}}</label>
                                 <select class="form-control select2" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $item)
                                            <option value="{{$item->name}}" @isset($company_settings) @if($company_settings->country == $item->name) selected @endif @endisset>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                              </div>
                              <div class="form-group col-md-6">
                              <label for="validationCustom02" class="form-label">{{__('Footer')}}</label>
                              <input type="text" name="footer" class="form-control form-control" value="@isset($company_settings) {{$company_settings->footer}} @endisset">
                          
                          
                              </div>

                             
                           </div>
                        
                         
                           
                         
                           <button type="submit" class="mr-1 btn btn-sm btn-primary">{{__('Save Changes')}}</button>
                                <button type="submit" class="btn btn-sm btn-dark">{{__('Reset')}}</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

@endsection
