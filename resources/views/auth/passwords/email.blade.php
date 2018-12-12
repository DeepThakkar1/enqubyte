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
    <div class="row justify-content-center text-center mt-3">
        <div class="col-md-5">
            <div class="auth-container">
                <a href="/"><img src="{{ url('img/logo.png') }}" height="70px"></a>
                <h1 class="mb-5 mt-4 font-weight-bold text-center">Forget Password?</h1>
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
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
