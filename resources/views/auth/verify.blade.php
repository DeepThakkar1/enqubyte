@extends('layouts.app')

@push('css')
    
    <style type="text/css">
        #sidebar, .custom-dashboard-navbar {
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
                <div class="info-icon custom-dashboard-info-icon">
                    <img src="/img/mail.png">
                </div>
                <div class="info-header">{{ __('Verify Your Email Address') }}</div>

                <div class="info-body" style="font-size: 19px;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {!! __('Before proceeding, please check your  <b>'. auth()->user()->email .'</b> email for a verification link.') !!}
                    {{ __('If you did not receive the email') }}, <a style="color: blue;" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    
                    <div class="mt-3">
                        <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" style="color: blue;" href="{{ route('verification.resend') }}"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
