@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Daily Meals Reports</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-3">
            <input type="date" class="form-control" placeholder="First name">

            </div>

            <div class="col-3">
            <input type="date" class="form-control" placeholder="First name">

            </div>
            <div class="col-3">
            <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Food</option>
                              <option value="0"> Arabic Bread</option>
                              <option value="1">Cheese</option>
                              <option value="0"> Salad</option>
                              <option value="1">Bread</option>
                              <option value="1">Paratta</option>
                             
                           </select>

            </div>
           
            <div class="col-1">
            <button type="submit" class="btn btn-primary rounded">Search</button>

            </div>
            <div class="col-1">
            <button type="submit" class="btn btn-primary rounded" onclick="window.print()">Print</button>

            </div>
</div>

            <div class="card-body">
             
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                        
                           <th>Breakfast Name</th>
                           <th>Menu Name</th>
                        
                        
                           
                           <th>Qnty</th>
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                        
                           
                           <td>Break Fast</td>
                         
                    
                           <td> Chicken</td>
                           <td>5</td>
                         
                          
                        </tr>
                       <tr>
                        
                          
                           <td>Break Fast</td>
                         
                    
                           <td> Appam</td>
                           <td>5</td>
                         
                          
                        </tr>

                        <tr>
                        
                        
                           <td>Lunch</td>
                         
                    
                          <td> Chicken,Arabic Breads, Paratta</td>
                           <td>15</td>
                         
                          
                        </tr>

                        <tr>
                        
                    
                           <td>Dinner</td>
                         
                    
                           <td> Chicken,Arabic Breads, Paratta</td>
                           <td>10</td>
                         
                          
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
