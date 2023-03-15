@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Expring Date</h4>
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
                        
                           <th>Customer Name</th>
                       
                           <th>Calories  Plan</th>
                        
                           <th>Start Date</th>
                           <th>Ending Date</th>
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                             <td>12/09/2022</td>
                    
                           <td>12/10/2022</td>
                       
                         
                          
                        </tr>
                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                             <td>12/09/2022</td>
                    
                           <td>12/10/2022</td>
                       
                         
                          
                        </tr>

                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                            <td>12/09/2022</td>
                    
                           <td>12/10/2022</td>
                         
                         
                          
                        </tr>

                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                            <td>12/09/2022</td>
                    
                           <td>12/10/2022</td>
                         
                         
                          
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
