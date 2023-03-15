@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Menu Updation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('menu-update') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                     <input type="hidden" name="menuid" value="{{$menu->id}}">
                     <div class="col-md-12">
                           <label for="validationCustom01" class="form-label">Menu Code</label>
                           <input value="{{$menu->menucode}}" type="text" class="form-control" id="validationCustom01" required name="menucode">
                           <div class="invalid-feedback">
                              Please Enter Menu Code
                           </div>
                        </div>
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Select Category</label>
                           <select class="form-select" id="validationCustom04" required name="category">
                           <option selected disabled value="">Select Category</option>
                        @foreach($category as $categorys)
                              
                              <option value="{{$categorys->id}}" @if($categorys->id == $menu->category){{"selected"}} @endif >
                              {{$categorys->categoryname}}</option>
                              @endforeach
                              

                             
                           </select>
                           <div class="invalid-feedback">
                              Please select a status.
                           </div>
                        </div>
                        <div class="col-md-12">
                       
                           <label for="validationCustom02" class="form-label">Menu Name</label>
                           <input type="text" value="{{$menu->menuname}}" class="form-control" id="validationCustom02" required name="menuname">
                           <div class="invalid-feedback">
                              Please Enter Menu name
                           </div>
                        </div>

                        <div class="col-md-12">
                         <label for="validationCustom02" class="form-label"> <img src="{{asset('storage/menuimages/'.$menu->image)}}" style="height:70px;width:75px"> </label>
                           <label for="validationCustom02" class="form-label">Menu Image</label>
                           <input type="file" class="form-control" id="validationCustom02"  name="image">
                          
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Menu From</label>
                           <input type="date"   class="form-control" id="validationCustom02" name="image">
                          
                           <div class="invalid-feedback">
                          
                           </div>
                        </div>
                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Menu TO</label>
                           <input type="date" class="form-control" id="validationCustom02"  name="image">
                          
                           <div class="invalid-feedback">
                            
                           </div>
                        </div>
                        
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Status</label>
                           <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Status</option>
                              <option value="0" @if($menu->status=="0"){{"selected"}}@endif> In Active</option>
                              <option value="1" @if($menu->status=="1"){{"selected"}}@endif>Active</option>
                             
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
