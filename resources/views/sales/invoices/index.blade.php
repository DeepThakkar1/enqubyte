@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Invoices</h2>
        <a href="/sales/invoices/add" class="btn btn-primary float-right">Add Invoice</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="product-list-menu">
                    <th>Invoice No.</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th class="text-right">Amount</th>
                    <th>Status</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $key => $invoice)
                <tr>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->visitor->fullname}}</td>
                    <td>{{$invoice->invoice_date}}</td>
                    <td>{{$invoice->due_date}}</td>
                    <td class="text-right">&#8377; {{$invoice->remaining_amount}}</td>
                    <td><span class="badge badge-warning">Pending</span> </td>
                    <td>
                        <a href="/sales/invoices/{{$invoice->id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="/sales/invoices/{{$invoice->id}}/edit" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                        <form method="post" action="/sales/invoices/{{$invoice->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure, You want to delete this invoice?');"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
