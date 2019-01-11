@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><a href="/" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a> Reports</h2>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Profit & Loss Account</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/profitandloss" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Cash Flow</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/cashaccount" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Customers Statement</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/customer" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Vendor Statement</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/vendor" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Product Statement</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/product" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Incentives Statement</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/salesman" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection