@extends('layouts.app')

@push('css')
    
    <style type="text/css">
        #sidebar, .custom-dashboard-navbar {
            display: none;
        }
        #content {
            width: 100% !important;
        }
    </style>

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center mt-md-5 pt-md-5">
        <div class="col-md-9">
            <div class="info-box text-center">
                <div class="info-icon">
                    <img src="/img/setup.gif" style="width: 170px;">
                </div>
                <div class="info-header font-weight-bold">{{ __('Your account is being setup.') }}</div>

                <div class="info-body" style="font-size: 22px;">
                    {!! __('You\'re just one step away from enhancing your business, we are configuring your account with a few default settings.') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
     
    window.setTimeout(function(){
        // Move to a new location or you can do something else
        axios.post('/setup', {})
            .then(function (response) {
               window.location.href = '/home';
            })
            .catch(function (error) {
                console.log(error);
            });
     }, 4500);
    
</script>
@endpush
