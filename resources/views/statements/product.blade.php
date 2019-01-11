@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Statements
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Products
        </h2>
    @include('statements.partials.filter')
    @include('statements.partials.tabs')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <table class="table dataTable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Product</th>
                        <th>Qty Sold</th>
                        <th>Total Revenue</th>
                        <th width="160px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statement as $key => $entry)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$entry->product->name}}</td>
                        <td>{{$entry->qty_sold}}</td>
                        <td>&#8377; {{$entry->revenue}}</td>
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
