@extends('layouts.app')

@section('content')





<div class="content-inner mt-5 py-0">
    <div class="row">
      
      

            <div class="card-body">
             
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>User-Id</th>
                           <th>Name</th>
                           <th>User Name</th>
                        
                           <th>User Role</th>
                           <th> Status</th>
                           <th> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach ($user as $users)
                        <tr>
                           <td>{{ ++$i }}</td>
                           <td>{{ $users->name}}</td>
                           <td>{{ $users->email}}</td>
                        
                           <td>{{ $users->userrole}}</td>
                         
                         
                           <td>

@if ($users->status == '0')
              <span class="badge bg-danger">Inactive</button>


@elseif($users->status == '1')
<span class="badge bg-primary">
Active
</span>



@endif  

 

</td>


<td>
                             <div class="flex align-items-center list-user-action">
                              
                                <!-- <a href="{{route('user-edit',$users->id)}}" class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                   <span class="btn-inner">
                                      <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      </svg>
                                   </span>
                                </a> -->
                                 
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
@endsection
