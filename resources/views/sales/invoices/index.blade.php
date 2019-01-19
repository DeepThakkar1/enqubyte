@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents headline-contents-height">
        <h2 class="d-inline-block headline-content">Invoices</h2>
        <div class="float-md-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    @if(request('start_date'))
                    <a href="/invoicesexcel?start_date={{request('start_date')}}&end_date={{request('end_date')}}" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    @else
                    <a href="/invoicesexcel" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    @endif
                    <a href="/invoicespdf" class="btn btn-light"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/invoicescsv" class="btn btn-light"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
            <a href="/sales/invoices/add" class="btn btn-primary">Add Invoice</a>
        </div>
    </div>
    @include('components.filters.datefilter')
    <div class="">
        <table class="table descDataTable">
            <thead>
                <tr class="product-list-menu">
                    <th>Invoice No.</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th class="text-right">Amount</th>
                    <th class="text-right">Remaining Amt</th>
                    <th>Status</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $key => $invoice)
                <tr>
                    <td>{{$invoice->sr_no}}</td>
                    <td>{{$invoice->visitor->fullname}}</td>
                    <td>{{$invoice->invoice_date}}</td>
                    <td>{{$invoice->due_date}}</td>
                    <td class="text-right">&#8377; {{$invoice->grand_total}}</td>
                    <td class="text-right">&#8377; {{$invoice->remaining_amount}}</td>
                    <td><span class="badge badge-{{$invoice->remaining_amount ? 'warning' : 'success'}}">{{$invoice->remaining_amount ? 'Pending' : 'Completed'}}</span> </td>
                    <td>
                        <a href="/sales/invoices/{{$invoice->sr_no}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
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
