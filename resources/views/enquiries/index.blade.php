@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Enquiries</h2>
        <a href="/enquiries/add" class="btn btn-primary float-right">Add Enquiry</a>
    </div>
    <!-- <hr> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="product-list-menu">
                    <th>Enquiry No.</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Followup Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $key => $enquiry)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$enquiry->customer->fullname}}</td>
                    <td>{{$enquiry->enquiry_date}}</td>
                    <td>{{$enquiry->followup_date}}</td>
                    <td>{{$enquiry->grand_total}}</td>
                    <td><span class="badge badge-warning">Pending</span> </td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:;" class="btn btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
