@extends('layouts.app')

@section('content')

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<div class="content-inner mt-5 py-0">
      <div>
         <div class="row">
            
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  
                  <div class="card-body">
                    
                  <form action="{{url('getmenus/')}}" role="form" enctype="multipart/form-data" method="post">
            {{csrf_field()}}

            <div class="col-lg-12">
              <label>Role</label>
              <select class="form-control" name="role" id="role" onchange="this.form.submit()" required>
                <option value="">select role</option>
                @foreach($data['roles'] as $role)
                <option @isset($data['curr_role']) @if($data['curr_role']==$role->id) selected @endif @endisset value="{{$role->id}}">{{$role->rolename}}</option>
                @endforeach
              </select>
            </div>
            <br>
            <br>
          </form>

          <form action="{{url('assignroles/')}}" role="form" enctype="multipart/form-data" method="post" id="menu_div" @isset($data['curr_role']) style="display:block;" @else style="display:none;" @endisset>
            {{csrf_field()}}
            <input type="hidden" name="role_id" id="role_id" @isset($data['curr_role']) value="{{$data['curr_role']}}" @endisset>
            <div class="row">
              <div class="card-body">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sl no</th>
                          <th>Menu</th>
                          <th>Sub Menu</th>
                       
                          <th>Select</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $i = 1; 
                      ?>
                        @isset($data['menus'])
                        @foreach($data['menus'] as $menu)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>
                            @if($menu['parent'] =='#')
                            <span style='font-weight:bold;color:black;'>{{$menu['name']}}</span>
                            @else
                            {{$menu['name']}}
                            @endif
                          </td>
                          <td></td>
                        
                          <td><input type="checkbox"  name="menu[]" value="{{$menu['id']}}" @if(in_array($menu['id'], $data['permitted_menus'])) checked @endif></td>
                        </tr>
                        @foreach($menu['submenu'] as $submenu)
                        <tr>
                          <td>{{$i++}}</td>
                          <td><li></li></td>
                          <td>{{$submenu['name']}}</td>
                         
                          <td><input type="checkbox"  name="menu[]" value="{{$submenu['id']}}" @if(in_array($submenu['id'], $data['permitted_menus'])) checked @endif></td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endisset
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Submit</button>
              <!-- <a href="#" class="btn btn-cancel">Clear</a> -->
            </div>
          </form>
                  </div>
               </div>
                
            </div>
         </div>
      </div>
      </div>

@endsection


