@foreach ($customer_arr as $customers)
<!-- Modal -->
<div class="modal" id="modal{{$customers['user_id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #3bb77e;">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <th>First name : </th>
                     <td>{{ $customers['firstname']}}</td>
                  </tr>
                  <tr>
                     <th>Last name : </th>
                     <td>{{ $customers['lastname']}}</td>
                  </tr>
                  <tr>
                     <th>Street address : </th>
                     <td>{{ $customers['streetaddress']}}</td>
                  </tr>
                  <tr>
                     <th>country : </th>
                     <td>{{ $customers['country']}}</td>
                  </tr>
                  <tr>
                     <th>Mobile : </th>
                     <td>{{ $customers['mobno']}}</td>
                  </tr>
                  <tr>
                     <th>Alternative mobile : </th>
                     <td>{{ $customers['alternativemob']}}</td>
                  </tr>
                  <tr>
                     <th>status : </th>
                     <td>

                        @if ($customers['status'] == '0')
                        <span class="badge bg-danger">Inactive</button>


                           @elseif($customers['status'] == '1')
                           <span class="badge bg-primary">
                              Active
                           </span>



                           @endif



                     </td>
                  </tr>
               </tbody>
            </table>


            <h3 style="padding-left: 21px;"> Subscrption Details </h3>
            <div class="table-responsive">


               <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                  <thead>
                     <tr class="ligth">
                        <th>Deit Plan</th>
                        <th>Calories Plan</th>
                        <th>Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>

                        <th>Status</th>


                     </tr>
                  </thead>
                  <tbody>
                     @if($customers['subscription'])
                     @foreach ($customers['subscription'] as $subscription)
                     <tr>
                        <td> {{$subscription['plan']}} </td>
                        <td> {{$subscription['calorie_plan']}} </td>
                        <td> {{$subscription['amount']}} </td>
                        <td> {{$subscription['start_date']}} </td>
                        <td> {{$subscription['end_date']}} </td>
                        <td>
                           @if ($subscription['status'] == '0')
                           <span class="badge bg-danger">Inactive</span>
                           @else($subscription['status'] == '1')
                           <span class="badge bg-primary">Active</span>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                     @endif

                  </tbody>
               </table>


            </div>


            <h3 style="padding-left: 21px;"> Dependencies Details </h3>

            <div class="table-responsive">


               <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                  <thead>
                     <tr class="ligth">
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Street address</th>
                        <th>country</th>
                        <th>Mobile</th>

                        <th>Status</th>


                     </tr>
                  </thead>
                  <tbody>
                     @if($customers['downline'])
                     @foreach ($customers['downline'] as $dwnline)
                     <tr>
                        <td> {{ $dwnline['firstname']}} </td>
                        <td> {{ $dwnline['lastname']}} </td>
                        <td> {{ $dwnline['streetaddress']}} </td>
                        <td> {{ $dwnline['country']}} </td>
                        <td> {{ $dwnline['mobno']}} </td>
                        <td> @if ($dwnline['status'] == '0')
                           <span class="badge bg-danger">Inactive</button>
                           <a class="btn btn-sm btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-bs-toggle="modal" data-bs-target="#modal123">

                              @elseif($dwnline['status'] == '1')
                              <span class="badge bg-primary">
                                 Active
                              </span>



                              @endif
                        </td>
                     </tr>
                     
                     @endforeach
                     @endif

                  </tbody>
               </table>


            </div>


            

            <h3 style="padding-left: 21px;">Dependencies Subscrption Details </h3>
            <div class="table-responsive">


               <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                  <thead>
                     <tr class="ligth">
                        <th>Name</th>
                        <th>Deit Plan</th>
                        <th>Calories Plan</th>
                        <th>Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>

                        <th>Status</th>


                     </tr>
                  </thead>
                  <tbody>
                  @if($customers['downline'])
                     @foreach ($customers['downline'] as $dwnline)
                     @if($dwnline['subscription'])
                     @foreach ($dwnline['subscription'] as $subscription)
                     <tr>
                        <td> {{$subscription['customer_name']}} </td>
                        <td> {{$subscription['plan']}} </td>
                        <td> {{$subscription['calorie_plan']}} </td>
                        <td> {{$subscription['amount']}} </td>
                        <td> {{$subscription['start_date']}} </td>
                        <td> {{$subscription['end_date']}} </td>
                        <td>
                           @if ($subscription['status'] == '0')
                           <span class="badge bg-danger">Inactive</span>
                           @else($subscription['status'] == '1')
                           <span class="badge bg-primary">Active</span>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                     @endif
                     @endforeach
                     @endif

                  </tbody>
               </table>


            </div>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
@endforeach