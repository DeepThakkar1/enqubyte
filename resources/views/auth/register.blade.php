@extends('layouts.app')

@push('css')
<style type="text/css">
    .navbar-laravel{
        display: none;
    }
    body {
        overflow: hidden;
    }
    .auth-container {
        overflow-y: auto;
    }
    .dashboard-all-content-section {
        margin-top: 0px !important; 
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-left ml-md-3">
        <div class="col-md-6 mt-3">
            <div class="auth-container">
                <div class="">
                    <a href="/">
                        <img src="{{ url('img/logo.png') }}" height="60px" class="mb-3">
                    </a>
                </div>
                <div class="user-signin-account">
                    <form id="wizard" method="POST" class="frmRegistration" action="{{ route('register') }}">
                        @csrf
                        @include('auth.registration.step1')
                        @include('auth.registration.step2')
                        @include('auth.registration.step3')
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center user-login-image-section">
            <img src="/img/PNG/Reports And Graphs 2-01.png" style="width: 100%">
        </div>    
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/jquery.steps.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>
@endpush