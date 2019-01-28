@extends('layouts.app')

@section('title', 'Enqubyte - Your business assistant | Sign up')

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
        <div class="col-md-6 mt-3">
            <div class="auth-container">
                <div class="login-logo-section">
                    <a href="/">
                        <img src="{{ url('img/logo.png') }}" height="60px" class="mb-3">
                    </a>
                </div>
                <div class="user-signin-account">
                    <form id="wizard" method="POST" class="frmRegistration" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="plan_name" value="{{ request()->has('plan') ? request('plan') : 'Free' }}">
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