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
                           <form action="{{ route('unlock') }}" method="POST"  class="text-start">
                            @csrf
                                    
                                        <div class="mb-3">
                                        <input type="password" name="password" class="form-control pe-5 @error('password') is-invalid @enderror" required="required"  placeholder="{{__('Password')}}"/ >
                                        <i class="las la-lock"></i>
                                @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror                                
                                       
                                       </div>

                                       <div class="mb-3">
                                       <a href="{{route('lock_logout')}}" class="text-primary" style="text-align: center;padding-left: 61px;">{{__('Logout & Switch User')}}</a>                             
                                       
                                       </div>
                                     
                                     
                                        
                                      
                                        <div class="text-center">
                                   
                                            <button type="submit"  class="btn btn-primary w-100 my-4 mb-4">  {{__('Continue')}}</button>
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
