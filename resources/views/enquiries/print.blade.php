<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enquiry ENV-00{{$enquiry->sr_no}}</title>

      <style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    /*.invoice-box table tr td:nth-child(2) {
        text-align: right;
    }*/

    .invoice-box table tr td.text-right {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        /*padding-bottom: 20px;*/
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
        border-top: 1px solid #ddd;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
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
                                <h3 style="margin: 5px 0px;">Enquiry : ENV-00{{$enquiry->sr_no}}</h3>
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
                                {{$enquiry->customer->phone ? $enquiry->customer->phone : '--'}}<br>
                                {{$enquiry->customer->email ? $enquiry->customer->email : '--'}}

                            </td>

                            <td class="text-right">
                                <b>Enquiry Number:</b> ENV-00{{$enquiry->sr_no}}<br>
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
      <!-- <script type="text/javascript">
      window.print();
    </script> -->
</body>
</html>