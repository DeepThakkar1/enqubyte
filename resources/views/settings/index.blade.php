@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents" style="border-bottom: solid 1px #f0f0f0;">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Settings</h2>
    </div>
</div>
    <!-- <hr> -->
    <div class="container-fluid">
        <ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" href="#pills-profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pills-company-tab"  href="#pills-company">Company</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" href="#pills-advance">Advance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" href="#pills-security">Security</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @include('settings.tabs.company')
            @include('settings.tabs.general')
            @include('settings.tabs.profile')
            @include('settings.tabs.security')
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
            var hash = window.location.hash;
            console.log(hash);
            $('ul.nav-pills a[href="' + hash + '"]').tab('show');

            $('.nav-pills .nav-link').on('click', function(){
                var url = $(this).attr('href');
                $('ul.nav-pills a[href="' + url + '"]').tab('show');
            });
        });
</script>
@endpush