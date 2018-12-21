@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="d-inline-block headline-content">Settings</h2>
    <hr>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-security" role="tab" aria-controls="pills-security" aria-selected="false">Security</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        @include('settings.tabs.general')
        @include('settings.tabs.profile')
        @include('settings.tabs.security')
    </div>
</div>
@endsection
