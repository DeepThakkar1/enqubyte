@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents headline-border-bottom">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Statements
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Vendor
        </h2>
        <div class="float-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="/vendorstatementexcel" class="btn btn-outline-dark"><i class="fa fa-file-excel"></i></a>
                    <a href="/vendorstatementpdf" class="btn btn-outline-dark"><i class="fa fa-file-pdf"></i></a>
                    <a href="/vendorstatementcsv" class="btn btn-outline-dark"><i class="fas fa-file-csv"></i></a>
                </div>
            </div>
        </div>
    </div>
        @include('components.tabs.tabularChart')
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
                <table class="table dataTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Total Payments</th>
                            <th width="160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $key => $vendor)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$vendor->name}} ({{$vendor->phone}})</td>
                            <td>&#8377; {{$vendor->total_payments}}</td>
                            <td>
                                <a href="/vendors/{{$vendor->id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
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
