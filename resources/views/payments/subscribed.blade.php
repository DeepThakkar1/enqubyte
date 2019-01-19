@extends('layouts.app')

@push('css')
    
    <style type="text/css">
        #sidebar {
            display: none;
        }
        #content {
            width: 100% !important;
        }
    </style>

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center mt-md-5 pt-md-5">
        <div class="col-md-9">
            <div class="info-box text-center">
                <div class="info-icon">
                    <img src="/img/subscribed.png">
                </div>
                <div class="info-header font-weight-bold">{{ __('Your Payment was successfull.') }}</div>

                <div class="info-body" style="font-size: 22px;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('We have recieved your payment and your account is activated successfully!') }}
                        </div>
                    @endif

                    {!! __('We will redirect you to your dashboard in ') !!} <span id="seconds">5</span> {!! __('seconds ') !!}
                    {{ __('If you do not redirect automatically') }}, <a style="color: blue;" href="{{ route('home') }}">{{ __('click here to go to dashboard') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    var time = 5;
    window.setInterval(function(){
        // Move to a new location or you can do something else
        $('#seconds').html(--time);
     }, 1000);
    window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "/home";
     }, 5000);
</script>
@endpush
