<style>
        
    .alert {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    margin-bottom: 90px;
    padding: 0.9375rem;
    position: absolute;
            top: 4%;
            right: 30px;
            width:27%;
}

@media(max-width: 575px) {
    .custom-alert-1 .media-body {
        display: block;
    }
    .alert .btn {
        margin-top: 8px;
    }
}
    </style>
    

@if(Session::has('success'))

<div class="alert alert-success bg-gradient-success mb-4" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="{{__('Close')}}">
                                            <i class="las la-times"></i>
                                        </button>
                                        <strong>{{__('Done!')}}</strong>  {{ Session::get('success') }}
                                    </div>

@endif

@if(Session::has('error'))

<div class="alert alert-solid alert-danger d-flex" role="alert">
                           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                 <use xlink:href="#exclamation-triangle-fill" />
                           </svg>
                           <div>
                      {{__('Error!')}} {{ Session::get('error') }}
                           </div>
                        </div>


@endif