@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-md-9">
            <div class="info-box text-center">
                <div class="info-icon">
                    <img src="/img/mail.png">
                </div>
                <div class="info-header">{{ __('Verify Your Email Address') }}</div>

                <div class="info-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {!! __('Before proceeding, please check your  <b>'. auth()->user()->email .'</b> email for a verification link.') !!}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
