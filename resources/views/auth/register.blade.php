@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <!-- <div class="card-header">{{ __('Register') }}</div> -->
                <div class="card-body">
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
<script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>
@endpush