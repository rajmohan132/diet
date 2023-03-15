
@extends('layouts.404')

@section('content')

<div class="wrapper">

<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-lg-12">
                <img src="{{ asset('assets/images/error/01.png') }}" class="img-fluid w-25" alt=""> 
                <img src=" {{ asset('assets/images/error/02.png') }}" class="img-fluid w-25 px-5" alt="">
                <img src=" {{ asset('assets/images/error/01.png') }}" class="img-fluid w-25" alt="">
                <h2 class="mb-0 mt-4">Page Not Found.</h2>
                <p class="mt-2"> </p>
                <div class="d-flex justify-content-center">
                    <a href="{{url('dashboard')}}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>    
      </div>
@endsection
