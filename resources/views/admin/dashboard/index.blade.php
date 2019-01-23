@extends('admin.app')

@section('content')

<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents" style="border-bottom: 1px solid #f0f0f0;">
        <h2 class="d-inline-block headline-content">Dashboard</h2>
    </div>

    <div class="row m-3">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Users</h5>
                    <h5 class="mr-5">{{ $usersCnt}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/enquiries">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Subscribers</h5>
                    <h5 class="mr-5">{{$usersCnt}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/sales/invoices">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Earnings</h5>
                    <h5 class="mr-5">&#8377; 123</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/purchases">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Performance</h5>
                    <h5 class="mr-5">123</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/statements/profitandloss">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="row m-3">
        <div class="col-xl-6 col-sm-6 mb-3">
            <div class="card" style="height: 373px;">
                <div class="card-header bg-light">
                    <h5 class="m-0">Resent Subscriber</h5>
                </div>
                <div class="card-body p-md-0">
                    <ul class="list-group no-rounded-corners" style="max-height: 325px;overflow-y: auto;">
                        @foreach($subscribers as $subscriber)
                        <li class="list-group-item flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ Avatar::create($subscriber->fullname)->toBase64() }}" style="width: 32px; height: 32px; margin-right: 7px; vertical-align: unset;">
                                    <div class="d-inline-block">
                                        <div class="mb-1 font-weight-bold">{{$subscriber->fullname}}</div>
                                        <div>{{$subscriber->email}}</div>
                                    </div>
                                </div>
                                <div>
                                    {{$subscriber->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
            <div class="card" style="height: 373px;">
                <div class="card-header bg-light">
                    <h5 class="m-0">Resent Users</h5>
                </div>
                <div class="card-body p-md-0">
                    <ul class="list-group no-rounded-corners" style="max-height: 325px;overflow-y: auto;">
                        @foreach($users as $user)
                        <li class="list-group-item flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ Avatar::create($user->fullname)->toBase64() }}" style="width: 32px; height: 32px; margin-right: 7px; vertical-align: unset;">
                                    <div class="d-inline-block">
                                        <div class="mb-1 font-weight-bold">{{$user->fullname}}</div>
                                        <div>{{$user->email}}</div>
                                    </div>
                                </div>
                                <div>
                                    {{$user->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('js')
<script src="{{asset('js/Chart.bundle.js')}}"></script>
<script src="{{asset('js/utils.js')}}"></script>
<script>


</script>
@endpush