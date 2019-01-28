@extends('layouts.app')

@section('title', 'Enqubyte - Your business assistant | Login')

@section('meta-description', 'Enqubyte is an all-in-one solution for managing a retail business at an ease
providing features to handle inquiries, sales, purchases and employees as well as provide
various reports that let you analyze your business.')

@section('meta-keywords', 'Manage Enquiries , Invoicing, Customers, stock, sales, centralised hub for all
your business needs, service based business, systematic track, Create detailed quotations,
Create detailed estimates, Manage your daily follow-ups, One-click Invoicing, Products and
Stock, Inventory management, stock management system, Maintain your list of products,
Record your Purchase orders, Record your Purchase Bills, Manage your vendor payments,
better business, estimate, Analyse customer, Ledgers, Statements, Record customer
payments, Simple Tax Management, Tax Management, Campaigns, SMS, WhatsApp and
Email Marketing, Track your Message clicks, target customers, Choose your target
audience, Advanced WhatsApp Marketing, WhatsApp Marketing, Salesmen, Payouts,
Incentives, Record incentives automatically, Easy incentive payouts, Reports, Graphs,
Reports & Graphs, Profit & Loss Account, Customer, Vendor and Salesmen statements,
Monthly reports, Enhance business, Enqubyte for business, software, erp software, crm,
inventory management, Business Analysis & Planning, Customer Satisfaction, monthly,
quarterly and yearly reports, Email & SMS notifications, maintaining business records,
multiple softwares for different purposes, business needs, business needs all in one
platform, Visitors, Products & Stock, Enquiries, Follow-ups, Follow-ups, Sales, Invoicing,
Salesmen, Incentives, Reports & Graphs, offer, plan, subscription for software')


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
        <div class="col-md-6">
            <div class="auth-container login-logo-section mt-3">
                <a href="/">
                    <img src="{{ url('img/logo.png') }}" height="60px">
                </a>
                <div class="user-signin-account">
                <h1 class="mb-5 mt-md-4">{{ __('Sign in to your account') }}</h1>
                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            @include('components.inputs.username', ['inputName' => 'company_username', 'inputPlaceholder' => 'Username', 'isRegister' => false])
                            @if ($errors->has('company_username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_username') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{-- <div class="form-check d-inline float-left">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div> --}}
                            <div class="float-right">
                                @if (Route::has('password.request'))
                                    <a style="font-size: 17px;" class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group mt-3 mb-0 text-center">
                            <button type="submit" class="btn btn-primary mb-4 btn-block btn-lg" style="padding-top: 5px;">
                                {{ __('Login') }}
                            </button>
                            <div class="loginSignUpSeparator"><span class="textInSeparator">or</span></div>
                            <p class="text-center" style="font-size: 17px;">
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
        <div class="col-md-6 d-flex align-items-center user-login-image-section">
            <img src="/img/PNG/Reports And Graphs 2-01.png" style="width: 100%">
        </div>
    </div>
</div>
@endsection
