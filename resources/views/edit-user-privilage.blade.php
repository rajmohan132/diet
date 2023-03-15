@extends('layouts.app')

@section('content')

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('user-privillages-update') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                    
                        

                        <input type="hidden" name="upid" value="{{$user_privilage->id}}">

                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">User Privillages</label>
                           <select class="form-select" id="validationCustom04" required name="user_role">
                              <option selected disabled value="">Select User Roles</option>
                               <option selected disabled value="">Select User Roles</option>
                              @foreach($userrole as $role)
                              <option value="{{$role->id}}" @if($role->id == $user_privilage->user_role){{"selected"}} @endif > 
                              {{$role->rolename}} 
                              </option>
                              @endforeach
                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a user role.
                           </div>


                           
                        </div>
                        <br><br>
                        <div class="row">
  <div class="col-lg-12">

  <div class="form-row user-permissions" id="user-permissions" style="margin-top: 42px;">
  <?php
  $privilages_array = [];
  $privilages_array = explode("," , $user_privilage->privilages);
  ?>
      @foreach($privilage->chunk(5) as $chunk)
        <div class="col-md-3 m-t-20 student">
          @foreach($chunk as $priv)
            <div class="custom-control custom-checkbox">
            <input type="checkbox" 
            @foreach($privilages_array as $pr) 
            @if($pr == $priv->id){{"checked"}}
            @endif 
            @endforeach  
            class="custom-control-input parent priv" id="{{$priv->id}}" name="privilages[]" value="{{$priv->id}}">
            <label class="custom-control-label" for="{{$priv->id}}">{{$priv->privilage}}</label>
          </div>
          @endforeach
        </div>
        @endforeach
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input parent " id="select_all">
            <label class="custom-control-label" for="select_all">Select All</label>
          </div>
      </div>


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


