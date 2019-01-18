@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents headline-border-bottom">
        <h2 class="d-inline-block headline-content"><a href="/" class="mr-2"><i class="fa fa-arrow-left"></i></a> Reports</h2>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Profit & Loss Account</h3>
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
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Monthly Report</h3>
                        <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="/statements/monthly" class="btn btn-outline-primary">View Statement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Cash Flow</h3>
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
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Customers Statement</h3>
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
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Vendor Statement</h3>
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
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Product Statement</h3>
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
                <div class="d-flex p-md-3">
                    <div class="px-md-4">
                        <h3 class="text-size-heading">Incentives Statement</h3>
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