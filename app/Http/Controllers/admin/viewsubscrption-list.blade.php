<style>
  
.check {
    display: inline-block;
    margin-right: 10px;
}
</style>
@extends('layouts.app')

@section('content')

<div class="content-inner mt-5 py-0">
<div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Package List</h4>
               </div>
            </div>
            <br><br>
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
            <br><br>
            <div class="card-body px-0">
               <div class="table-responsive">
               <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                           <tr class="ligth">
                              <th>Profile</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Other Contact</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>Join Date</th>
                              <th style="min-width: 100px">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($customer as $customers)
                           <tr>
                              <td class="text-center"> <img src="{!! asset("storage/profileimages/".$customers->image) !!}" alt="" class="bg-soft-primary rounded img-fluid avatar-40 me-3"> </td>
                              <td>{{ $customers->firstname}}</td>
                              <td>{{ $customers->mobno}}</td>
                              <td>{{ $customers->alternativemob}}</td>
                              <td>{{ $customers->getuser->email}}</td>
                              <td>
                                 @if ($customers->status == '0')
                                 <span class="badge bg-danger">Inactive</button>
                                    @elseif($customers->status == '1')
                                    <span class="badge bg-primary">
                                       Active
                                    </span>
                                    @endif
                              </td>
                              <td>{{ $customers->created_at}}</td>
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">open</a> -->
                                    <a class="btn btn-sm btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-bs-toggle="modal" data-bs-target="#modal{{$customers->user_id}}">
                                       <span class="btn-inner">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                             <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" />
                                          </svg>
                                       </span>
                                    </a>
                                    <a href="{{route('add-customer-downline',$customers->user_id)}}" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                       <span class="btn-inner">
                                          <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87651 15.2063C6.03251 15.2063 2.74951 15.7873 2.74951 18.1153C2.74951 20.4433 6.01251 21.0453 9.87651 21.0453C13.7215 21.0453 17.0035 20.4633 17.0035 18.1363C17.0035 15.8093 13.7415 15.2063 9.87651 15.2063Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8766 11.886C12.3996 11.886 14.4446 9.841 14.4446 7.318C14.4446 4.795 12.3996 2.75 9.8766 2.75C7.3546 2.75 5.3096 4.795 5.3096 7.318C5.3006 9.832 7.3306 11.877 9.8456 11.886H9.8766Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M19.2036 8.66919V12.6792" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M21.2497 10.6741H17.1597" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                       </span>
                                    </a>
                                    <a href="{{route('customer-edit',$customers->id)}}" class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                       </span>
                                    </a>
                                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                             <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                       </span>
                                    </a>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                          
                        </tbody>
                     </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
      </div>

      
      <!-- Modal -->
      
      <div class="modal fade bd-example-modal-xl" id="assignFood" tabindex="-1" role="dialog"  aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Satus Change</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
               <div class="modal-body">
           <div class="card">
               
                <div class="card-body">
               
                    <form action="{{route('add-bulk-menu')}}" method="POST" >
                    @csrf
                    <div id="result">
                    
                    </div>
                        <!-- <table>
                           <tr>
                              <thead><input type="date" name="current_date"></thead>
                              <thead>
                                 <table>
                                    <tr>
                                       <thead>
                                          <select>
                                             <option value="">--Meal Type--</option>
                                          </select>   
                                       </thead>
                                    </tr>
                                    <tr>
                                       <thead>
                                          <select>
                                             <option value="">--Menu--</option>
                                          </select>   
                                       </thead>
                                    </tr>
                                 </table>
                              </thead>
                           </tr>
                        </table> -->
                    
                </div>
            </div>
               </div>
               <div class="modal-footer">
                
                  <button type="submit" class="btn-close btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Submit</button>
               </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Modal -->
      

      <!-- Modal components -->
      

@endsection
