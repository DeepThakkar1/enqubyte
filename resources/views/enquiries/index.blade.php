@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Enquiries</h2>
        <a href="/enquiries/add" class="btn btn-primary float-right">Add Enquiry</a>
    </div>
    @include('components.filters.datefilter')
    <div class="mt-4">
        <table class="table descDataTable">
            <thead>
                <tr class="product-list-menu">
                    <th>Enquiry No.</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Followup Date</th>
                    <th class="text-right">Amount</th>
                    <th>Status</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $key => $enquiry)
                <tr>
                    <td>{{$enquiry->sr_no}}</td>
                    <td>{{$enquiry->customer->fullname}}</td>
                    <td>{{$enquiry->enquiry_date}}</td>
                    <td>{{$enquiry->followup_date}}</td>
                    <td class="text-right">{{$enquiry->grand_total}}</td>
                    <td><span class="badge badge-{{$enquiry->status == -1 ? 'danger' : ($enquiry->status == 1 ? 'success' : 'warning')}}">{{$enquiry->status == -1 ? 'Cancelled' : ($enquiry->status == 1 ? 'Converted' : 'Pending')}}</span> </td>
                    <td>
                        <a href="/enquiries/{{$enquiry->id}}" class="btn btn-sm" title="Edit"><i class="fa fa-eye"></i></a>
                        @if(!$enquiry->status == -1 && !$enquiry->status == 1)
                        <a href="/enquiries/{{$enquiry->id}}/edit" class="btn btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                        @else
                        <a href="#" class="btn btn-sm disabled" title="Edit"><i class="fa fa-pencil"></i></a>
                        @endif
                        @if($enquiry->status == 1)
                        <a href="#" class="btn btn-sm disabled" title="Delete"><i class="fa fa-trash"></i></a>
                        @else
                        <form method="post" action="/enquiries/{{$enquiry->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm" title="Delete" onclick="return confirm('Are you sure, You want to delete this enquiry?');"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
