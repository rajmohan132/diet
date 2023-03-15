@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Delivery Report </h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-5">
            <input type="date" class="form-control" placeholder="First name">

            </div>

            <div class="col-5">
            <input type="date" class="form-control" placeholder="First name">

            </div>
            <div class="col-2">
            <button type="submit" class="btn btn-primary rounded">Search</button>

            </div>
</div>

            <div class="card-body">
             
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Customer-Id</th>
                           <th>Customer Name</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                           <th>Items</th>
                           <th>Address</th>
                           <th>Delivery date</th>
                           <th>Delivered by</th>
                           <th>Status</th>
                  
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>dosha, idili</td>
                           <td>kollam</td>
                           <td>12/10/1990</td>
                           <td>Raj</td>
                           <td>Delivred</td>
                         
                          
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>Anu George</td>
                           <td>6 Months</td>
                           <td>138 Calories</td>
                          
                           <td>dosha, idili</td>
                           <td>Tvm</td>
                           <td>12/10/1990</td>
                           <td>Raj</td>
                           <td>Delivred</td>
                         
                          
                        </tr>
                        
                        
                     </tbody>
                     
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>
@endsection