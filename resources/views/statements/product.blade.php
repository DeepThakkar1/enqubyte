@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents headline-contents-height">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Products
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
    {{-- @include('components.tabs.tabularChart') --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <table class="table dataTable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Product</th>
                        <th>Qty Sold</th>
                        <th>Total Revenue</th>
                        <th width="160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statement as $key => $entry)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$entry->product->name}}</td>
                        <td>{{$entry->qty_sold}}</td>
                        <td>&#8377; {{number_format($entry->revenue)}}</td>
                        <td>
                            <a href="/products/{{$entry->product_id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            Chart
        </div>
    </div>

    @endsection
