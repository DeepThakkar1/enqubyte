@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Profit & Loss Account
        </h2>
        <div class="float-md-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="/profitandlossexcel" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    <a href="/profitandlosspdf" class="btn btn-light"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/profitandlosscsv" class="btn btn-light"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
        </div>
    </div>
    @include('components.filters.datefilter')
    <div class="card">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div class="px-4 expenses-txt">
                    <h3 class="">Net Profit </h3>
                    <h4 class="">&#8377; {{$profit}}</h4>
                </div>
                <div class="px-md-4 expenses-txt">
                    <h4 class="">=</h4>
                </div>
                <div class="px-4 expenses-txt">
                    <h3 class="">Total sale</h3>
                    <h4 class="">&#8377; {{$totalSale}}</h4>
                </div>
                <div class="px-md-4 expenses-txt">
                    <h4 class="">-</h4>
                </div>
                <div class="px-4 expenses-txt">
                    <h3 class="">Expenses</h3>
                    <h4 class="">&#8377; {{$expenses}}</h4>
                </div>
            </div>
        </div>
    </div>
    @include('components.tabs.tabularChart')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <table class="table reports-show-puroduct-purchaes mb-0">
                <tbody>
                    <tr class="bg-light">
                        <th colspan="2">Expenses</th>
                    </tr>
                    <tr>
                        <td>Total Purchase Made</td>
                        <td style="text-align: right;">&#8377; {{$totalPurchase}}</td>
                    </tr>
                    <tr>
                        <td class="border-top-0">Incentives Paid</td>
                        <td class="border-top-0" style="text-align: right;">&#8377; {{$incentives}}</td>
                    </tr>
                    <tr class="bg-light">
                        <th colspan="2">Income</th>
                    </tr>
                    <tr>
                        <td>Total Sale</td>
                        <td style="text-align: right;">&#8377; {{$totalSale}}</td>
                    </tr>
                    <tr class="bg-light">
                        <th class="border-top-0" style="font-size: 15px;">Net Profit</th>
                        <th class="border-top-0" style="text-align: right;font-size: 15px;">&#8377; {{$profit}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            @include('statements.partials.profitandlosschart')
        </div>
    </div>

    @endsection

