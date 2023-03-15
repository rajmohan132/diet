@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
        
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> {{__('App Settings')}}</h4>
                     </div>
                  </div>
                  <div class="card-body">
                 
                  <form id="update_app_settings" enctype="multipart/form-data" >
        @csrf
    <input type="hidden" value="{{$app_settings->id}}" name="id">
                 
                  <div class="new-user-info">
                      
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="fname">{{__('App Name')}}</label>
                                 <input type="text" class="form-control" placeholder="" name="app_name" id="name" value="{{$app_settings->app_name}}">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">{{__('APP URL')}}</label>
                                 <input type="text" value="{{$app_settings->app_url}}" name="app_url" class="form-control" placeholder="Ex : http://localhost" required disabled>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add1">{{__('APP_DEBUG')}}</label>
                                 <select class="form-control select2" name="app_debug">
                                                <option>{{__('Select')}}</option>
                                                <option value="true" @if($app_settings->app_debug == "true") selected @endif >
                                            True
                                        </option>
                                        <option value="false" @if($app_settings->app_debug == "false") selected @endif>
                                            False
                                        </option>
                                            </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="add2">{{__('DB_HOST')}}</label>
                                 <input type="text" value="{{$app_settings->db_host}}" name="db_host" class="form-control" placeholder="Ex : http://localhost/" required disabled>
                              </div>
                              
                              <div class="form-group col-md-6">
                                 <label class="form-label">DB DATABASE</label>
                                 <input type="text" value="{{$app_settings->db_database}}" name="db_database" class="form-control" placeholder="Ex : demo_db" required disabled>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="mobno">{{__('DB PASSWORD')}}</label>
                                 <input type="text" value="{{$app_settings->db_password}}" name="db_password" class="form-control" placeholder="Ex : password" disabled>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="altconno">{{__('Purchase Key')}}</label>
                                 <input type="text" name="auth_key" class="form-control form-control" value="{{$app_settings->purchase_key}}" required disabled>
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pno">{{__('Software Version')}}</label>
                                 <input type="text" value="{{$app_settings->software_version}}" name="software_version" class="form-control" required>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="city">{{__('DB_CONNECTION')}}</label>
                                 <input type="text" value="{{$app_settings->db_connection}}" name="db_connection" class="form-control" placeholder="Ex : mysql" required disabled>
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="form-label" for="uname">{{__('APP_MODE')}}</label>
                                 <select class="form-control select2" name="app_mode">
                                                <option>{{__('Select')}}</option>
                                                <option value="live" @if($app_settings->app_mode == "live") selected @endif>
                                            Live
                                        </option>
                                        <option value="development" @if($app_settings->app_mode == "development") selected @endif>
                                            Dev
                                        </option>
                                            </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">{{__('Screen Lock Time')}}</label>
                                 <input type="text" value="{{$app_settings->lock_time}}" name="lock_time" class="form-control" required>
                              </div>
                              <div class="form-group col-md-6">
                              <label for="validationCustom02" class="form-label">{{__('DB_PORT')}}</label>
                              <input type="text" value="{{$app_settings->db_port}}" name="db_port" class="form-control" placeholder="Env Port" required disabled>
                          
                          
                              </div>

                              <div class="form-group col-md-6">
                              <label for="validationCustom02" class="form-label">{{__('DB USERNAME')}}</label>
                              <input type="text" value="{{$app_settings->db_username}}" name="db_username" class="form-control" placeholder="Database Password" required disabled>
                          
                          
                              </div>
                           </div>
                        
                         
                           
                         
                           <button type="submit" class="mr-1 btn btn-sm btn-primary" >{{__('Save Changes')}}</button>
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
