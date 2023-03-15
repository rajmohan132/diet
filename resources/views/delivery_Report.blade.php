@extends('layouts.app')

@section('content')







<div class="content-inner mt-5 py-0">
    <div class="row">
      
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
               <div class="header-title ">
                  <h4 class="card-title">Delivery Report</h4>
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
            
            <div class="col-2">
             <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Delivery Boy</option>
                              <option value="0"> Shearain</option>
                              <option value="1">Anu</option>
                              <option value="0"> Jalal</option>
                              <option value="1">Jaseel</option>
                             
                           </select>

            </div>
            
            <div class="col-2">
             <select class="form-select" id="validationCustom04" required name="status">
                              <option selected disabled value="">Deleivery Area</option>
                              <option value="0"> Al khor</option>
                              <option value="1">Doha</option>
                              <option value="0"> Al Sadd</option>
                              <option value="1">Bin Omran</option>
                             
                           </select>

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
                           <th>Sub Plan Name</th>
                           <th>Customer Name</th>
                           <th>Delivered by</th>
                                <th>Delivery Area</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>jassel</td>
                              <td>Al kohor</td>
                           
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>6 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>Jalal</td>
                              <td>Doha</td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>Jalal</td>
                              <td>Bin Omran</td>
                           
                        </tr>
                        <tr>
                           <td>4</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>Jalal</td>
                              <td>Lusail</td>
                           
                        </tr><tr>
                           <td>5</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>jassel</td>
                            <td>Bin Omran</td>
                        </tr>
                        <tr>
                           <td>6</td>
                           <td>2 Months</td>
                           <td>138 Calories</td>
                           <td>Anu George</td>
                           <td>jassel</td>
                               <td>Lusail</td>
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
