@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Plan Report</h4>
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
                           <th>Order-Id</th>
                           <th>Plan Name</th>
                          
                         
                           <th>Plan Duration Start Date </th>
                           <th>Plan Duration End Date</th>
                          
                           <th>Order Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>2 Months</td>
                          
                         
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                         
                           <td><span class="badge bg-primary">Active</span></td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>6 Months</td>
                         
                          
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                           <td><span class="badge bg-primary">Active</span></td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>2 Months</td>
                          
                         
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                           <td><span class="badge bg-primary">Active</span></td>
                        </tr>
                        <tr>
                           <td>4</td>
                           <td>2 Months</td>
                          
                         
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                           <td><span class="badge bg-primary">Active</span></td>
                        </tr><tr>
                           <td>5</td>
                           <td>2 Months</td>
                         
                           
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                           <td><span class="badge bg-primary">Active</span></td>
                        </tr>
                        <tr>
                           <td>6</td>
                           <td>2 Months</td>
                          
                         
                           <td>2020/04/25</td>
                           <td>2020/06/25</td>
                           <td><span class="badge bg-primary">Active</span></td>
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
