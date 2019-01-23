@extends('layouts.app')

@push('css')
<style type="text/css">
    .dashboard-all-content-section {
        margin-top: 0px !important; 
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center text-center mt-3">
        <div class="col-md-5">
            <div class="auth-container">
                <h1 class="mb-5 mt-4 font-weight-bold text-center">Forget your password?</h1>
                <p style="
                    font-size: 21px;
                    padding-bottom: 0;
                    margin-bottom: 0;
                ">Enter your account email address, we will send you a password reset link.
                    </p>
                 <div class="">
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                               
                                <div class="col-md-12">
                                    <input id="email" style="height: 45px;" placeholder="E-mail Address" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button style="" type="submit" class="btn btn-primary custom-password-reset-btn d-block w-100">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
