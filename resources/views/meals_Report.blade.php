@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Daily Meals Report</h4>
               </div>
            </div>
            <br>
            <div class="row" style="padding-left: 29px;">
            <div class="col-2">
            <input type="date" class="form-control" placeholder="First name">

            </div>

            <div class="col-2">
            <input type="date" class="form-control" placeholder="First name">

            </div>
            <div class="col-3">
            <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select Subplan</option>
                              <option value="0"> 1000</option>
                              <option value="1">1300</option>
                              <option value="0"> 1600</option>
                              <option value="1">1900</option>
                             
                           </select>

            </div>
            <div class="col-3">
            <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Select </option>
                              <option value="0"> 120/60</option>
                              <option value="1">100/60</option>
                              <option value="0"> 140/100</option>
                              <option value="1">100/80</option>
                             
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
                        
                           <th>Meal Type</th>
                          
                           <th>Calories plan</th>
                           <th>Items</th>
                           <th>Qnty</th>
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                        
                         
                          
                           <td>Break-Fast,Snacks,Dinner</td>
                           <td>138 Calories</td>
                    
                           
                           <td>Arabic Bread,Cheese,SaladParatta</td>
                          <td>10</td>
                          
                        </tr>
                        <tr>
                        
                         
                          
                           <td>Break-Fast,Snacks,Dinner</td>
                           <td>138 Calories</td>
                    
                           
                           <td>Arabic Bread,Cheese,SaladParatta</td>
                          <td>5</td>
                          
                        </tr>
                     
                     <tr>
                        
                         
                          
                           <td>Break-Fast,Snacks,Dinner</td>
                           <td>138 Calories</td>
                    
                           
                           <td>Arabic Bread,Cheese,SaladParatta</td>
                          <td>15</td>
                          
                        </tr>
                     
                     <tr>
                        
                         
                          
                           <td>Break-Fast,Snacks,Dinner</td>
                           <td>138 Calories</td>
                    
                           
                           <td>Arabic Bread,Cheese,SaladParatta</td>
                          <td>14</td>
                          
                        </tr>
                     
                     <tr>
                        
                         
                          
                           <td>Break-Fast,Snacks,Dinner</td>
                           <td>138 Calories</td>
                    
                           
                           <td>Arabic Bread,Cheese,SaladParatta</td>
                          <td>50</td>
                          
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
