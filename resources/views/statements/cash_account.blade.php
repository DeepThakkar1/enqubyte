@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Statements
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Cash Flow
        </h2>
        @include('components.exportbuttons.topbar')
    </div>
    @include('components.filters.datefilter')

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-around align-items-center p-3">
                <div class="px-4">
                    <h3 class="">Net Cash Change </h3>
                    <h4 class="">&#8377; {{$profit}}</h4>
                </div>
                <div class="px-4">
                    <h4 class="">=</h4>
                </div>
                <div class="px-4">
                    <h3 class="">Cash Inflow</h3>
                    <h4 class="">&#8377; {{$totalSale}}</h4>
                </div>
                <div class="px-4">
                    <h4 class="">-</h4>
                </div>
                <div class="px-4">
                    <h3 class="">Cash Outflow</h3>
                    <h4 class="">&#8377; {{$expenses}}</h4>
                </div>
            </div>
        </div>
    </div>
    @include('components.tabs.tabularChart')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <table class="table">
                <tbody>
                    <tr class="bg-light">
                        <th colspan="2">Expenses</th>
                    </tr>
                    <tr>
                        <td>Total Purchase Made</td>
                        <td>&#8377; {{$totalPurchase}}</td>
                    </tr>
                    <tr>
                        <td>Incentives Paid</td>
                        <td>&#8377; {{$incentives}}</td>
                    </tr>
                    <tr class="bg-light">
                        <th colspan="2">Income</th>
                    </tr>
                    <tr>
                        <td>Total Sale</td>
                        <td>&#8377; {{$totalSale}}</td>
                    </tr>
                    <tr class="bg-light">
                        <th>Net Cash Change</th>
                        <th>&#8377; {{$profit}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            @include('statements.partials.cashchart')
        </div>
    </div>

    @endsection
