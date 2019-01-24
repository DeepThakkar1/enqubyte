<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice INV-00{{$invoice->sr_no}}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/print.css')}}">
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                @if(auth()->user()->company_logo)
                                    <img src="{{Storage::url(auth()->user()->company_logo)}}" style="height: 50px;">
                                    @else
                                    <img src="{{asset('img/logo.png')}}" style="height: 50px;">
                                @endif
                            </td>
                            <td class="text-right">
                                <h3 style="margin: 5px 0px;">Invoice : INV-00{{$invoice->sr_no}}</h3>
                                {{auth()->user()->company_name}}<br>
                                {{auth()->user()->company_address ? auth()->user()->company_address : '--'}}<br>
                                {{auth()->user()->company_phone ? auth()->user()->company_phone : '--'}}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                <h5 style="margin: 0">Invoice to</h5>
                                {{$invoice->customer->fullname}}<br>
                                {{$invoice->customer->address ? $invoice->customer->address : '--'}}<br>
                                {{$invoice->customer->phone ? $invoice->customer->phone : '--'}}<br>
                                {{$invoice->customer->email ? $invoice->customer->email : '--'}}
                            </td>
                            <td class="text-right">
                                <b>Invoice Number:</b> INV-00{{$invoice->sr_no}}<br>
                                <b>Created Date:</b> {{$invoice->invoice_date}}<br>
                                <b>Due Date:</b> {{$invoice->due_date}}<br>
                                <h5 class="dueAmount"><b>Amount Due (INR) : </b> &#8377; {{$invoice->remaining_amount}}</h5>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td class="center">#</td>
                <td width="350px">Item</td>
                <td class="right">Price</td>
                <td class="center">Qty</td>
                <td class="center">Tax</td>
                <td class="right">Total</td>
            </tr>
            @foreach($invoice->invoiceitems as $key => $item)
            <tr class="item {{$key == count($invoice->invoiceitems) - 1 ? 'last' : ''}}">
                <td class="center">{{$key + 1}}</td>
                <td class="">{{$item->product->name}} <br> <small>{{$item->product->description}}</small></td>
                <td class="right">&#8377; {{$item->price}}</td>
                <td class="center">{{$item->qty}}</td>
                <td class="center">{{$item->tax}} %</td>
                <td class="right">&#8377; {{$item->product_tot_amt}}</td>
            </tr>
            @endforeach
            <tr class="total">
                    <td colspan="5"></td>
                    <td class="right border-top-0"><strong>Subtotal : </strong> &#8377; {{$invoice->sub_tot_amt}}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="right"><strong>Discount : </strong> {!! isset($invoice->discount_type) && $invoice->discount_type ==0 ? '&#8377;' : ''!!} {{$invoice->discount}} {{isset($invoice->discount_type) && $invoice->discount_type ==1 ? '%' : ''}}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="right grandTotalAmount">
                        <strong>Total : &#8377; {{$invoice->grand_total}}</strong>
                    </td>
                </tr>
                @if(count($invoice->payments))
                    @foreach($invoice->payments as $payment)
                    <tr>
                        <td colspan="5" class="left">
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
                        <td colspan="5" class="left">
                            <strong>Amount Due (INR):</strong>
                        </td>
                        <td class="right">
                            <strong>&#8377; {{$invoice->remaining_amount}}</strong>
                        </td>
                    </tr>
                @endif
            </tr>
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>