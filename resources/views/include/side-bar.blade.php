@php
$all_orders = App\Models\Order::count();
$pending_orders = App\Models\Order::where('order_status', '1')->count();
$out_for_delivery = App\Models\Order::where('order_status', '2')->count();
$delivered = App\Models\Order::where('order_status', '3')->count();
$company_data = App\Models\CompanySettings::first();
$app_data = App\Models\AppSettings::first();
$curr_id = auth::user()->id;
$curr_role = auth::user()->userrole;

$privilage = new App\Models\Privilage();
$privilage = $privilage->getprivilage($curr_role, $curr_id);

@endphp

<style>
    .sidebar-theme {
    background: {{$company_data['colour']}};
}
</style>

<aside class="sidebar sidebar-default sidebar-hover sidebar-mini navs-pill-all ">
      <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{url('dashboard')}}" class="navbar-brand">
          <!--Logo start-->
          
          <div class="logo-hover">
          <img src="{{ URL::asset('company_details/'.$company_data->company_logo) }}" alt="" style="width: 151px;">
          </div>
          <!--logo End-->
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
          <i class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </i>
        </div>
      </div>
      <div class="sidebar-body pt-0 data-scrollbar">
        <div class="navbar-collapse" id="sidebar">
          <!-- Sidebar Menu Start -->
               
                <ul class="navbar-nav iq-main-menu">
                @foreach($privilage as $data)
                @if($data['route'] != '#')
                <li class="nav-item">
              <a class="nav-link" href="{{url($data['route'])}}" >
                <i class="icon">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                  </svg>
                </i>
                <span class="item-name">{{$data['name']}}</span>
              </a>

              
            </li>


            @else

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-special{{$data['id']}}" role="button" aria-expanded="false" aria-controls="sidebar-special">
                <i class="icon">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M13.3051 5.88243V6.06547C12.8144 6.05584 12.3237 6.05584 11.8331 6.05584V5.89206C11.8331 5.22733 11.2737 4.68784 10.6064 4.68784H9.63482C8.52589 4.68784 7.62305 3.80152 7.62305 2.72254C7.62305 2.32755 7.95671 2 8.35906 2C8.77123 2 9.09508 2.32755 9.09508 2.72254C9.09508 3.01155 9.34042 3.24276 9.63482 3.24276H10.6064C12.0882 3.2524 13.2953 4.43736 13.3051 5.88243Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.164 6.08279C15.4791 6.08712 15.7949 6.09145 16.1119 6.09469C19.5172 6.09469 22 8.52241 22 11.875V16.1813C22 19.5339 19.5172 21.9616 16.1119 21.9616C14.7478 21.9905 13.3837 22.0001 12.0098 22.0001C10.6359 22.0001 9.25221 21.9905 7.88813 21.9616C4.48283 21.9616 2 19.5339 2 16.1813V11.875C2 8.52241 4.48283 6.09469 7.89794 6.09469C9.18351 6.07542 10.4985 6.05615 11.8332 6.05615C12.3238 6.05615 12.8145 6.05615 13.3052 6.06579C13.9238 6.06579 14.5425 6.07427 15.164 6.08279ZM10.8518 14.7459H9.82139V15.767C9.82139 16.162 9.48773 16.4896 9.08538 16.4896C8.67321 16.4896 8.34936 16.162 8.34936 15.767V14.7459H7.30913C6.90677 14.7459 6.57311 14.4279 6.57311 14.0233C6.57311 13.6283 6.90677 13.3008 7.30913 13.3008H8.34936V12.2892C8.34936 11.8942 8.67321 11.5667 9.08538 11.5667C9.48773 11.5667 9.82139 11.8942 9.82139 12.2892V13.3008H10.8518C11.2542 13.3008 11.5878 13.6283 11.5878 14.0233C11.5878 14.4279 11.2542 14.7459 10.8518 14.7459ZM15.0226 13.1177H15.1207C15.5231 13.1177 15.8567 12.7998 15.8567 12.3952C15.8567 12.0002 15.5231 11.6727 15.1207 11.6727H15.0226C14.6104 11.6727 14.2866 12.0002 14.2866 12.3952C14.2866 12.7998 14.6104 13.1177 15.0226 13.1177ZM16.7007 16.4318H16.7988C17.2012 16.4318 17.5348 16.1139 17.5348 15.7092C17.5348 15.3143 17.2012 14.9867 16.7988 14.9867H16.7007C16.2885 14.9867 15.9647 15.3143 15.9647 15.7092C15.9647 16.1139 16.2885 16.4318 16.7007 16.4318Z" fill="currentColor"></path>
                  </svg>
                </i>
                <span class="item-name">{{$data['name']}} </span>
                <i class="right-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </i>
              </a>
              <ul class="sub-nav collapse" id="sidebar-special{{$data['id']}}" data-bs-parent="#sidebar">
              @foreach($data['submenu'] as $submenu)
                  <li class="nav-item">
                  <a class="nav-link " href="{{url($submenu['route'])}}">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
                  
                    <span class="item-name">{{$submenu['name']}}</span>
                  </a>
                </li>
                @endforeach
                
              


                
              </ul>
            </li>


                @endif
                @endforeach


               @if($curr_role=='1')
                <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#app" role="button" aria-expanded="false" aria-controls="utilities-error" >
                <i class="icon">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M2 11.0786C2.05 13.4166 2.19 17.4156 2.21 17.8566C2.281 18.7996 2.642 19.7526 3.204 20.4246C3.986 21.3676 4.949 21.7886 6.292 21.7886C8.148 21.7986 10.194 21.7986 12.181 21.7986C14.176 21.7986 16.112 21.7986 17.747 21.7886C19.071 21.7886 20.064 21.3566 20.836 20.4246C21.398 19.7526 21.759 18.7896 21.81 17.8566C21.83 17.4856 21.93 13.1446 21.99 11.0786H2Z" fill="currentColor"></path>
                    <path d="M11.2451 15.3843V16.6783C11.2451 17.0923 11.5811 17.4283 11.9951 17.4283C12.4091 17.4283 12.7451 17.0923 12.7451 16.6783V15.3843C12.7451 14.9703 12.4091 14.6343 11.9951 14.6343C11.5811 14.6343 11.2451 14.9703 11.2451 15.3843Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.211 14.5565C10.111 14.9195 9.762 15.1515 9.384 15.1015C6.833 14.7455 4.395 13.8405 2.337 12.4815C2.126 12.3435 2 12.1075 2 11.8555V8.38949C2 6.28949 3.712 4.58149 5.817 4.58149H7.784C7.972 3.12949 9.202 2.00049 10.704 2.00049H13.286C14.787 2.00049 16.018 3.12949 16.206 4.58149H18.183C20.282 4.58149 21.99 6.28949 21.99 8.38949V11.8555C21.99 12.1075 21.863 12.3425 21.654 12.4815C19.592 13.8465 17.144 14.7555 14.576 15.1105C14.541 15.1155 14.507 15.1175 14.473 15.1175C14.134 15.1175 13.831 14.8885 13.746 14.5525C13.544 13.7565 12.821 13.1995 11.99 13.1995C11.148 13.1995 10.433 13.7445 10.211 14.5565ZM13.286 3.50049H10.704C10.031 3.50049 9.469 3.96049 9.301 4.58149H14.688C14.52 3.96049 13.958 3.50049 13.286 3.50049Z" fill="currentColor"></path>
                  </svg>
                </i>
                <span class="item-name"> Settings</span>
                <i class="right-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </i>
              </a>
              <ul class="sub-nav collapse" id="app" data-parent="#sidebar">
                <li class="nav-item">
                  <a class="nav-link " href="{{url('business_settings')}}">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
         
                    <span class="item-name">App Settings</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{url('company_settings')}}">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> W </i>
                    <span class="item-name"> Company Settings</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link " href="mail-update.html">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
               
                    <span class="item-name">Mail Settings</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{route('setting.backup')}}">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> V </i>
                    <span class="item-name">Db Backup</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link " onclick="emptyDatabase()">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> V </i>
                    <span class="item-name">Db Clear</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " onclick="clear_cache()">
                    <i class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> V </i>
                    <span class="item-name">Cache Clear</span>
                  </a>
                </li>
              </ul>
            </li>
            
            

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#log" role="button" aria-expanded="false" aria-controls="sidebar-log">
                <i class="icon">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.53162 2.93677C10.7165 1.66727 13.402 1.68946 15.5664 2.99489C17.7095 4.32691 19.012 6.70418 18.9998 9.26144C18.95 11.8019 17.5533 14.19 15.8075 16.0361C14.7998 17.1064 13.6726 18.0528 12.4488 18.856C12.3228 18.9289 12.1848 18.9777 12.0415 19C11.9036 18.9941 11.7693 18.9534 11.6508 18.8814C9.78243 17.6746 8.14334 16.134 6.81233 14.334C5.69859 12.8314 5.06584 11.016 5 9.13442C4.99856 6.57225 6.34677 4.20627 8.53162 2.93677ZM9.79416 10.1948C10.1617 11.1008 11.0292 11.6918 11.9916 11.6918C12.6221 11.6964 13.2282 11.4438 13.6748 10.9905C14.1214 10.5371 14.3715 9.92064 14.3692 9.27838C14.3726 8.29804 13.7955 7.41231 12.9073 7.03477C12.0191 6.65723 10.995 6.86235 10.3133 7.55435C9.63159 8.24635 9.42664 9.28872 9.79416 10.1948Z" fill="currentColor"></path>
                    <ellipse opacity="0.4" cx="12" cy="21" rx="5" ry="1" fill="currentColor"></ellipse>
                  </svg>
                </i>
                <span class="item-name">Log Out</span>
                <i class="right-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </i>
              </a>
              
            </li>
            @endif

                </ul>


              
          <!-- Sidebar Menu End -->
        </div>
      </div>
      <div class="sidebar-footer"></div>
    </aside>