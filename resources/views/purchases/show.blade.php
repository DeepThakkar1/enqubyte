@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">
            <a href="/purchases" class="mr-1"><i class="fa fa-arrow-left"></i></a> Purchase Order
        </h2>
    </div>
    <div class="container px-5">
    <div class="d-flex align-self-center">
        <div class="py-2">
            <div>Status</div>
            <div class="bg-{{$purchaseOrder->remaining_amount ? 'warning' : 'success'}} text-white px-2 rounded mt-2"><span class="purchaseOrderStatus"> {{$purchaseOrder->remaining_amount ? 'Pending' : 'Completed'}} </span></div>
        </div>
        <div class="px-4 py-2">
            <div>Vendor</div>
            <h3><a href="" class="text-primary custom-primary-text"> {{$purchaseOrder->vendor->name}}</a></h3>
        </div>
        <div class="ml-auto p-2">
            <div class="d-flex">
                <div class="px-4">
                    <div>Amount Due</div>
                    <h3 class="mt-2 Due">&#8377; <span class="purchaseOrderAmt">{{$purchaseOrder->remaining_amount}}</span></h3>
                </div>
                <div>
                    <div>Due Date</div>
                    <h3 class="mt-2 Due">{{$purchaseOrder->due_date}}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">Create purchase order</h3>
                    <div class=""><b>Created:</b> {{$purchaseOrder->created_at->diffForHumans()}}</div>
                </div>
                <div class="ml-auto p-2">
                    <a href="/purchases/{{$purchaseOrder->id}}/edit" class="btn btn-outline-primary">Edit Invoice</a>
                </div>
            </div>
        </div>
    </div> -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">P/O-00{{$purchaseOrder->sr_no}}</h3>
                    <p>Created : {{ $purchaseOrder->created_at->diffForHumans() }}
                </div>
                <div class="ml-auto p-2">
                    @if($purchaseOrder->remaining_amount)
                    <a href="#recordPaymentModal" data-toggle="modal" class="btn btn-outline-primary btnRecordPayment">Record a Payment</a>
                    @else
                    <a href="#" class="btn btn-outline-primary disabled">Record a Payment</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container px-5 mt-3">
        <div class="card">
            <div class="card-header">
                P/O
                <strong>{{$purchaseOrder->sr_no}}</strong>
                <span class="float-right"> <strong>Status:</strong> <span class="purchaseOrderStatus">{{$purchaseOrder->remaining_amount ? 'Pending' : 'Completed'}}</span></span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-8">
                        <h6 class="mb-3">Bill To:</h6>
                        <div>
                            <strong>{{$purchaseOrder->vendor->name}}</strong>
                        </div>
                        <div>{{$purchaseOrder->vendor->address}}</div>
                        <div>{{$purchaseOrder->vendor->phone}}</div>
                        <div>{{$purchaseOrder->vendor->email}}</div>
                    </div>
                    <div class="col-sm-4">
                        <!-- <h6 class="mb-3">Bill To:</h6> -->
                        <div>
                            <strong>P/O Number : </strong> {{$purchaseOrder->sr_no}}
                        </div>
                        <div><strong>Invoice Date : </strong> {{$purchaseOrder->purchase_date}}</div>
                        <div><strong>Payment Due : </strong> {{$purchaseOrder->due_date}}</div>
                        <div><strong>Amount Due (INR) : </strong> &#8377; <span class="purchaseOrderAmt">{{$purchaseOrder->remaining_amount}} </span></div>
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
                            @foreach($purchaseOrder->purchaseitems as $key => $item)
                            <tr>
                                <td class="center">{{$key + 1}}</td>
                                <td class="left strong">{{$item->product->name}}</td>
                                <td class="left">{{$item->product->description}}</td>
                                <td class="right">&#8377; {{$item->price}}</td>
                                <td class="center">{{$item->qty}}</td>
                                <td class="center">{{$item->tax}} %</td>
                                <td class="right">&#8377; {{$item->product_tot_amt}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-5 col-sm-5 ml-auto">
                        <table class="table table-clear table-purchaseOrderTotal">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right" width="130">&#8377; {{$purchaseOrder->sub_tot_amt}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>&#8377; {{$purchaseOrder->grand_total}}</strong>
                                    </td>
                                </tr>
                                @if(count($purchaseOrder->payments))
                                    @foreach($purchaseOrder->payments as $payment)
                                    <tr>
                                        <td class="left">
                                            Payment on {{ $payment->payment_date}} using
                                            @if($payment->payment_method == 1)
                                            Bank Payment :
                                            @elseif($payment->payment_method == 2)
                                            Cash :
                                            @elseif($payment->payment_method == 3)
                                            Cheque :
                                            @elseif($payment->payment_method == 4)
                                            Credit Card :
                                            @else
                                            Other :
                                            @endif
                                        </td>
                                        <td class="right">
                                            <strong>&#8377; {{$payment->amount}}</strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="rowAmountDue">
                                        <td class="left">
                                            <strong>Amount Due (INR):</strong>
                                        </td>
                                        <td class="right">
                                            <strong>&#8377; {{$purchaseOrder->remaining_amount}}</strong>
                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade in recordPaymentModal" id="recordPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record a payment for this purchaseOrder</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmRecordPayment">
                @csrf
                <div class="modal-body">
                    <p>Record a payment you’ve already made, such as cash, cheque, or bank payment.</p>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Payment Date<sup class="error">*</sup></label>
                            <input type="text" name="payment_date" class="form-control datepicker" autocomplete="off" value="{{date('d-m-Y')}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Amount<sup class="error">*</sup></label>
                            <input type="text" id="amountInput" name="amount" value="{{isset($purchaseOrder->remaining_amount) ? $purchaseOrder->remaining_amount : ''}}" class="form-control" autocomplete="off" placeholder="Amount" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <label>Payment Method<sup class="error">*</sup></label>
                            <select class="form-control" name="payment_method" required>
                                <option value="" selected disabled>Select Method</option>
                                <option value="1">Bank Payment</option>
                                <option value="2">Cash</option>
                                <option value="3">Cheque</option>
                                <option value="4">Credit Card</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Memo / notes</label>
                        <textarea name="note" class="form-control" placeholder="Memo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="recordPayment" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        $('#recordPayment').on('click', function(){
            var data = $('.frmRecordPayment').serialize();
            axios.post('/purchases/{{isset($purchaseOrder) ? $purchaseOrder->id : ''}}/recordpayment', data)
            .then(function(response){
                $('.rowAmountDue').hide();
                // $('.purchaseOrderAmt').html(response.data.)
                var paymentType;
                if (response.data.payment.payment_method ==1) {
                    paymentType= 'Bank Payment';
                }else if(response.data.payment.payment_method ==2){
                    paymentType= 'Cash';
                }else if(response.data.payment.payment_method ==3){
                    paymentType= 'Cheque';
                }else if(response.data.payment.payment_method ==4){
                    paymentType= 'Credit Card';
                }else{
                    paymentType= 'Other';
                }
                var html = '<tr><td class="left">\
                            Payment on ' + response.data.payment.payment_date + ' using ' + paymentType + ' :</td>\
                            <td class="right">\
                            <strong>&#8377; ' + response.data.payment.amount + '</strong>\
                            </td></tr><tr class="border-top"><td class="left">\
                            <strong>Amount Due (INR):</strong></td>\
                            <td class="right">\
                            <strong>&#8377; ' + response.data.purchaseOrder.remaining_amount + '</strong>\
                            </td></tr>';
                $('.table-purchaseOrderTotal tbody').append(html);
                $('.purchaseOrderAmt').html(response.data.purchaseOrder.remaining_amount);
                $('.frmRecordPayment').trigger('reset');
                $("#amountInput").val(response.data.purchaseOrder.remaining_amount);
                $('.btnRecordPayment').addClass(response.data.purchaseOrder.remaining_amount ? '' : 'disabled');
                $('.bg-warning.text-white.px-2.rounded').removeClass('bg-warning').addClass(response.data.purchaseOrder.remaining_amount ? 'bg-warning' : 'bg-success');

                $('.purchaseOrderStatus').html(response.data.purchaseOrder.remaining_amount ? 'Pending' : 'Completed');
                $('.recordPaymentModal').modal('hide');
            })
        });
    </script>
@endpush