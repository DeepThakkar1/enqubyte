@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span>
            <a href="/home"> Home  </a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Statements
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Customer
        </h2>
    </div>
    <div class="table-responsive">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Total Earnings</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$customer->fullname}} ({{$customer->phone}})</td>
                    <td>&#8377; {{$customer->total_earnings}}</td>
                    <td>
                        <a href="/statements/customer/{{$customer->id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
