@extends('layouts.app')

@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Category Updation</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{ route('category-update') }}" enctype="multipart/form-data" method="POST">
                     @csrf
                     <input type="hidden" name="categoryid"  value="{{$category->id}}">
                     
                     <div class="col-md-12">
                           <label for="validationCustom01" class="form-label">Category Code</label>
                           <input value="{{$category->categorycode}}" type="text" class="form-control" id="validationCustom01" required name="categorycode">
                           <div class="invalid-feedback">
                              Please Enter Category Code
                           </div>
                        </div>
                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Category Name</label>
                           <input value="{{$category->categoryname}}" type="text" class="form-control" id="validationCustom02" required name="categoryname">
                           <div class="invalid-feedback">
                              Please Enter Category name
                           </div>
                        </div>

                        <div class="col-md-12">
                        <label for="validationCustom02" class="form-label"> <img src="{{asset('storage/subplanimages/'.$category->image)}}" style="height:70px;width:75px"> </label>
                           <label for="validationCustom02" class="form-label">Category Image</label>
                           <input type="file" class="form-control" id="validationCustom02" name="image">
<!--                           
                           <div class="invalid-feedback">
                              Please select a Image.
                           </div> -->
                        </div>
                        
                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Status</label>
                           <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Status</option>
                              <option value="0" @if($category->status=="0"){{"selected"}}@endif > In Active</option>
                              <option value="1" @if($category->status=="1"){{"selected"}}@endif >Active</option>
                             
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
