@extends('layouts.app-login')

@section('content')
<!-- <div id="loading">
      <div class="loader simple-loader">
         <img src="{{ asset('assets/images/loading.gif') }}"/>
      </div>   
    </div> -->
<main class="main-content main-content-bg mt-0">
        <div class="page-header min-vh-100" style="background-image: url('{{ asset('assets/images/login-bg.jpg') }}')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent text-center">
                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2">
                                    <img src="{{ asset('assets/images/Diet-Market.png') }}" class="login-logo">
                                    
                                </div>
                            </div>
                            <div class="card-body px-lg-5 pt-0">
                                <div class="" x-show="resetpassword == false" >
                                    <div class="text-muted mb-4">
                                        <!-- <small>Login to Continue</small> -->
                                    </div>
                                    @include('include.alert')
                           <form action="{{ route('login') }}" method="POST"  class="text-start">
                            @csrf
                                    
                                        <div class="mb-3">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter your email " name="email" required="required">
                                                                                    </div>
                                        <div class="mb-3">
                                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" aria-describedby="password" placeholder="Enter your Password "  name="password" required="required">
                                                                                    </div>
                                        
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                   
                                            <button type="submit"  class="btn btn-primary w-100 my-4 mb-4">Login</button>
                                        </div>
                                        <div class="mb-2 position-relative text-center">
                                            <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                Powered by <a href="#" class="text-dark fw-600" target="_blank">Artisans</a>
                                            </p>
                                        </div>
                                                                            </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

<script>
    $(document).ready(function() {
        // show the alert
        setTimeout(function() {
            $(".alert").alert('close');
        }, 2000);
    });

    
</script>
