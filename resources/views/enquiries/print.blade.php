<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enquiry ENQ-00{{$enquiry->sr_no}}</title>

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
                                <h3 style="margin: 5px 0px;">Enquiry : ENQ-00{{$enquiry->sr_no}}</h3>
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
                                <h5 style="margin: 0">Enquiry to</h5>
                                {{$enquiry->customer->fullname}}<br>
                                {{$enquiry->customer->address ? $enquiry->customer->address : '--'}}<br>
                                {{$enquiry->customer->phone ? $enquiry->customer->phone : '--'}}<br>
                                {{$enquiry->customer->email ? $enquiry->customer->email : '--'}}
                            </td>

                            <td class="text-right">
                                <b>Enquiry Number:</b> ENQ-00{{$enquiry->sr_no}}<br>
                                <b>Created Date:</b> {{$enquiry->enquiry_date}}<br>
                                <b>Followup Date:</b> {{$enquiry->followup_date}}
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
            @foreach($enquiry->enquiryitems as $key => $item)
            <tr class="item {{$key == count($enquiry->enquiryitems) - 1 ? 'last' : ''}}">
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
                    <td class="right border-top-0"><strong>Subtotal : </strong> &#8377; {{$enquiry->sub_tot_amt}}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="right"><strong>Discount : </strong> {!! isset($enquiry->discount_type) && $enquiry->discount_type ==0 ? '&#8377;' : ''!!} {{$enquiry->discount}} {{isset($enquiry->discount_type) && $enquiry->discount_type ==1 ? '%' : ''}}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="right grandTotalAmount">
                        <strong>Total : &#8377; {{$enquiry->grand_total}}</strong>
                    </td>
                </tr>
            </tr>
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>