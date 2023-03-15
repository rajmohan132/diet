@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Item Meals Report</h4>
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
                        
                           <th>Customer Name</th>
                           <th>Plan Name</th>
                           <th>Sub Plan Name</th>
                        
                           <th>Calories</th>
                           <th>Sub Calories</th>
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1000</td>
                           <td>120/60</td>
                         
                          
                        </tr>
                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1000</td>
                           <td>100/60</td>
                         
                          
                        </tr>

                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1300</td>
                           <td>140/100</td>
                         
                          
                        </tr>

                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1300</td>
                           <td>100/80</td>
                         
                          
                        </tr>


                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1100</td>
                           <td>120/80</td>
                         
                          
                        </tr>


                        <tr>
                        
                        <td>Anu George</td>
                        <td>2 Months</td>
                        <td>138 Calories</td>
                 
                        <td>1100</td>
                        <td>100/80</td>
                      
                       
                     </tr>
                        

                        <tr>
                        
                           <td>Anu George</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                    
                           <td>1200</td>
                           <td>100/80</td>
                         
                          
                        </tr>

                        <tr>
                        
                        <td>Anu George</td>
                        <td>2 Months</td>
                        <td>138 Calories</td>
                 
                        <td>1200</td>
                        <td>120/100</td>
                      
                       
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
