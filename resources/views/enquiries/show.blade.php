@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><a href="/enquiries" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a> Enquiry</h2>
        <!-- <a href="/enquiries/add" class="btn btn-primary float-right">Add Enquiry : </a> -->
    </div>
    <div class="container px-5 ">
        <div class="d-flex align-self-center">
            <div class="py-2">
                <div>Status</div>
                <div class="bg-{{$enquiry->status == -1 ? 'danger' : ($enquiry->status == 1 ? 'success' : 'warning')}} text-white px-2 rounded">{{$enquiry->status == -1 ? 'Cancelled' : ($enquiry->status == 1 ? 'Converted' : 'Pending')}}</div>
            </div>
            <div class="px-4 py-2">
                <div>Customer</div>
                <h3><a href="" class="text-primary"> {{$enquiry->customer->fullname}}</a></h3>
            </div>
            <div class="ml-auto p-2">
                <div class="d-flex">
                    @if(isset($enquiry->invoice))
                    <div class="px-4">
                        <div>Invoice</div>
                        <h3>
                        <a href="/sales/invoices/{{$enquiry->invoice->id}}" target="_blank" class="text-primary"># Invoice {{$enquiry->invoice->id}} </a>
                        </h3>
                    </div>
                    @endif
                    <div class="pr-4">
                        <div>Amount Due</div>
                        <h3>&#8377; {{$enquiry->grand_total}}</h3>
                    </div>
                    <div>
                        <div>Followup Date</div>
                        <h3>{{$enquiry->followup_date}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Create enquiry</h3>
                        <div class=""><b>Created:</b> {{$enquiry->created_at->diffForHumans()}}</div>
                    </div>
                    <div class="ml-auto p-2">
                        @if(!$enquiry->status == 1 && !$enquiry->status == -1)
                        <a href="/enquiries/{{$enquiry->id}}/edit" class="btn btn-outline-primary">Edit Enquiry </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Followup Date</h3>
                        <div class=""> {{$enquiry->followup_date}}</div>
                    </div>
                    <div class="ml-auto p-2">
                        @if(!$enquiry->status == 1 && !$enquiry->status == -1)
                        <a href="#changeFollowupDateModal" data-toggle="modal" class="btn btn-outline-primary">Change Date </a>
                        @else
                        <a href="javascript:;" class="btn btn-outline-primary disabled"  title="Convert to Invoice">Change Date</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Send enquiry</h3>
                        <div class=""><b>Skipped:</b> You never sent this enquiry.</div>
                    </div>
                    <div class="ml-auto p-2">
                        <a href="#" class="btn btn-outline-primary">Send Enquiry </a>
                        <a href="#" class="btn btn-outline-primary">Mark as Sent</a>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex p-3">
                    <div class="px-4">
                        <h3 class="">Get Invoice</h3>
                        @if(isset($enquiry->invoice))
                        <div class=""><a href="/sales/invoices/{{$enquiry->invoice->id}}" class="text-primary" target="_blank"># Invoice {{$enquiry->invoice->id}} </a> </div>
                        @endif
                    </div>
                    <div class="ml-auto p-2">
                        @if(!$enquiry->status == -1)
                        <a href="#cancelEnquiryModal" data-toggle="modal" class="btn btn-outline-danger" title="Cancel Enquiry">Cancel Enquiry</a>
                        @endif
                        @if(!$enquiry->status == 1)
                        <a href="/enquiries/{{$enquiry->id}}/invoice" class="btn btn-outline-primary" title="Convert to Invoice">Convert to Invoice</a>
                        @endif
                        @if($enquiry->status == 1)
                        <a href="/sales/invoices/{{$enquiry->invoice->id}}" target="_blank" class="btn btn-outline-primary" title="View Invoice">View Invoice</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-5 mt-3">
        <div class="card">
            <div class="card-header">
                Enquiry :
                <strong>{{$enquiry->id}}</strong>
                <span class="float-right"> <strong>Status:</strong> {{$enquiry->status == 1 ? 'Converted' : 'Pending'}}</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{auth()->user()->company_name}}</strong>
                        </div>
                        <div>Email: {{auth()->user()->email}}</div>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>{{$enquiry->customer->fullname}}</strong>
                        </div>
                        <div>{{$enquiry->customer->address}}</div>
                        <div>{{$enquiry->customer->phone}}</div>
                        <div>{{$enquiry->customer->email}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="center">Tax</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiry->enquiryitems as $key => $item)
                            <tr>
                                <td class="center">{{$key + 1}}</td>
                                <td class="left strong">{{$item->product->name}}</td>
                                <td class="left">{{$item->product->description}}</td>
                                <td class="right">{{$item->price}}</td>
                                <td class="center">{{$item->qty}}</td>
                                <td class="center">{{$item->tax}} %</td>
                                <td class="right">{{$item->product_tot_amt}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">&#8377; {{$enquiry->sub_tot_amt}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right">{!! isset($enquiry->discount_type) && $enquiry->discount_type ==0 ? '&#8377;' : ''!!} {{$enquiry->discount}} {{isset($enquiry->discount_type) && $enquiry->discount_type ==1 ? '%' : ''}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>&#8377; {{$enquiry->grand_total}}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade in cancelEnquiryModal" id="cancelEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Enquiry</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order? <br>When you cancel this order you doesn't change in that enquiry.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-modal">Close</button>
                <a href="/enquiries/{{$enquiry->id}}/cancel" class="btn btn-danger">Cancel Enquiry</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in changeFollowupDateModal" id="changeFollowupDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Followup Date</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/enquiries/{{$enquiry->id}}/changefollowupdate" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Follow Up Date</label>
                        <input type="text" class="form-control datepicker" name="followup_date" autocomplete="off" placeholder="Enquiry followup date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection