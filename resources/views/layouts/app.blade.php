@php
$company_data = App\Models\CompanySettings::first();
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($app_data) {{$app_data->app_name}} @else APP @endisset |  @isset($company_data) {{$company_data->company_name}} @else Diet App @endisset </title>
    <link rel="shortcut icon" href="{{ URL::asset('company_details/'.$company_data->fav_icon)}}" />
    <!-- Scripts -->
    @include('include.head-css')
</head>
<body class=" " style="">
    <div class="position-relative">
      <div class="user-img1">
        <svg width="1857" viewBox="0 0 1857 327" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.05078 189.348C86.8841 109.514 348.951 -25.2523 734.551 74.3477C1120.15 173.948 1641.22 91.181 1853.55 37.3477" stroke="#EA6A12" stroke-opacity="0.3" />
          <path d="M0.99839 152.331C90.9502 80.6133 364.495 -28.9952 739.062 106.31C1113.63 241.616 1640.16 208.056 1856.6 174.363" stroke="#EA6A12" stroke-opacity="0.3" />
        </svg>
      </div>
    </div>
    @include('include.alert')
  
      @include('include.side-bar')
      <main class="main-content">
      @include('include.top-bar')
@yield('content')
@include('include.footer')
</main>
@include('include.scripts')
</body>
</html>
