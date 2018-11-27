@extends('layouts.app')

@push('css')
<style type="text/css">
    .navbar-laravel{
        display: none;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center  mt-4">
        <div class="col-md-5">
            <div class="auth-container">
                <h3 class="mb-3 text-center font-weight-bold">{{ __('Enqubyte') }}</h3>
                <h1 class="mb-5 mt-4 font-weight-bold text-center">{{ __('Sign in') }}</h1>
                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            @include('components.inputs.username', ['inputName' => 'company_username', 'inputPlaceholder' => 'Username'])
                            @if ($errors->has('company_username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_username') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-check d-inline float-left">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="float-right">
                                @if (Route::has('password.request'))
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group mt-3 mb-0 text-center">
                            <button type="submit" class="btn btn-primary mb-4 btn-block btn-lg">
                                {{ __('Login') }}
                            </button>
                            <div class="loginSignUpSeparator"><span class="textInSeparator">or</span></div>
                            <p class="text-center">
                                Don't have a Enqubyte account yet?
                                <a class="btn-link" href="{{ route('register') }}">
                                    {{ __('Sign Up') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
