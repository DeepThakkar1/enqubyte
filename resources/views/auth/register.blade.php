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
        <div class="col-md-6">
            <div class="auth-container">
                <img src="{{ url('img/logo.png') }}" height="70px" class="mb-3">
                <div class="">
                    <form id="wizard" method="POST" class="frmRegistration" action="{{ route('register') }}">
                        @csrf
                        @include('auth.registration.step1')
                        @include('auth.registration.step2')
                        @include('auth.registration.step3')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/jquery.steps.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>
@endpush