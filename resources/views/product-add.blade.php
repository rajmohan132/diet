@extends('layouts.app')
<style>
          .MultiCheckBox {
            border:1px solid #e2e2e2;
            padding: 5px;
            border-radius:4px;
            cursor:pointer;
            background-color: #fff;
        }

        .MultiCheckBox .k-icon{ 
            font-size: 15px;
            float: right;
            font-weight: bolder;
            margin-top: -7px;
            height: 10px;
            width: 14px;
            color:#787878;
        } 

        .MultiCheckBoxDetail {
            display:none;
            position:absolute;
            border:1px solid #e2e2e2;
            overflow-y:hidden;
            background-color: #fff;
        }

        .MultiCheckBoxDetailBody {
            overflow-y:scroll;
        }

            .MultiCheckBoxDetail .cont  {
                clear:both;
                overflow: hidden;
                padding: 2px;
            }

            .MultiCheckBoxDetail .cont:hover  {
                background-color:#cfcfcf;
            }

            .MultiCheckBoxDetailBody > div > div {
                float:left;
            }

        .MultiCheckBoxDetail>div>div:nth-child(1) {
        
        }

        .MultiCheckBoxDetailHeader {
            overflow:hidden;
            position:relative;
            height: 28px;
            background-color:#3d3d3d;
        }

            .MultiCheckBoxDetailHeader>input {
                position: absolute;
                top: 4px;
                left: 3px;
            }

            .MultiCheckBoxDetailHeader>div {
                position: absolute;
                top: 5px;
                left: 24px;
                color:#fff;
            }
            </style>
@section('content')


<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Daily Food</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                     <form class="row g-3 needs-validation" novalidate action="{{route('product-add.store')}}" enctype="multipart/form-data" method="POST">
                     @csrf
                     
                        

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Deit plan Period</label>
                           <select class="form-select" id="dietplan" required name="plan">
                              <option selected disabled value="">Select Deit plan Period</option>
                              @foreach($plan as $plan)
                              <option value="{{$plan->id}}">{{$plan->planname}}</option>
                             @endforeach
                             </select>
                        </div>


                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label"> Calories Plan </label>
                           <select class="form-select" id="subplan" required name="subplan">
                              <option selected disabled value="">Select  Calories Plan</option>
                               @foreach($subplan as $subplan)
                              <option value="{{$subplan->id}}">{{$subplan->splanname}}</option>
                             @endforeach
                             
                           </select>
                        </div>



<div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Choose Meal Type</label>

                           
                           <div class="multiSelect">
                              <select id="customer-category" onchange="getSelectedOptions(this)"  class="multiSelect_field " name="category[]" 
                                       multiple data-placeholder="Select meal type">
                              @foreach($category as $category)
                              <option value="{{$category->id}}">{{$category->categoryname}}</option>
                             @endforeach
                              </select>
                           </div>
                          
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom02" class="form-label">Choose Menu</label>
                           <div class="multiSelect">
                              <select id="menu" class="multiSelect_field" name="menu[]" multiple data-placeholder="Select menu type">
                              @foreach($menu as $menu)
                              <option value="{{$menu->id}}">{{$menu->menuname}}</option>
                             @endforeach
                              </select>
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


                        <div class="col-md-12">
                           <label for="validationCustom04" class="form-label">Is Custom</label>
                           <input type="checkbox" name="is_custom" id="is_custom" value="1">
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


