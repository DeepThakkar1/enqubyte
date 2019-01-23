@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><a href="/sales/invoices" class="mr-1"><i class="fa fa-arrow-left"></i></a> Edit Invoice</h2>
        <div class="float-right">
            <a href="/sales/invoices/{{$invoice->id}}" class="btn btn-primary custom-back-btn">View Invoice</a>
        </div>
    </div>
    <!-- <hr> -->
    <div class="card border-top-0">
        <form method="post" action="/sales/invoices/{{$invoice->id}}/update">
            @csrf
            <div class="card-body p-0">
                <div class="row pl-0 py-4 m-0">
                    <div class="col-sm-4 form-group">
                        <label>Invoice Number</label>
                        <input type="text" name="" class="form-control" value="{{$invoice->sr_no}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Customer</label>
                        <select class="form-control selectCustomer" name="customer_id">
                            <option selected disabled>-- Choose Customer --</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{$invoice->customer_id == $customer->id ? 'selected' : ''}}>{{$customer->fullname}} ({{$customer->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Salesman</label>
                        <select class="form-control selectWithSearch selectEmployee" name="employee_id">
                            <option selected disabled>-- Choose Salesman --</option>
                            <option value="0" {{$invoice->employee_id == 0 ? 'selected' : ''}}>None</option>
                            @foreach($salesmans as $salesman)
                            <option value="{{$salesman->id}}" {{$invoice->employee_id == $salesman->id ? 'selected' : ''}}>{{$salesman->fullname}} ({{$salesman->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="invoice_date" value="{{$invoice->invoice_date}}" placeholder="Invoice date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Due Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="due_date" value="{{$invoice->due_date}}" placeholder="Due date">
                    </div>
                </div>
                <!-- <hr> -->
                <div class="table-responsive m-0" style="position: relative;">
                    <table class="table table-invoiceItems">
                        <thead>
                            <tr class="product-list-menu">
                                <th>Items</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
                                @if(auth()->user()->taxmode)
                                <th>Tax</th>
                                @endif
                                <th class="text-right">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="tableBodyItems">
                            @foreach($invoiceitems as $item)
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px">
                                        <option selected disabled>-- Choose Product --</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}" {{$item->product_id ==$product->id ? 'selected' : ''}}>{{$product->name}} ({{$product->product_code}})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" style="width: 150px">{{$item->description}}</textarea>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" style="width: 80px" value="{{$item->qty}}" class="form-control form-control-sm input-qty">
                                </td>
                                <td>
                                    <input type="text" name="price[]" style="width: 120px" value="{{$item->price}}" class="form-control form-control-sm input-price">
                                </td>
                                @if(auth()->user()->taxmode)
                                <td>
                                    <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">
                                        <option selected disabled>-- Choose Tax --</option>
                                        <option value="0" {{$item->tax == 0 ? 'selected' : ''}}>None</option>
                                        <?php $taxes = getTaxes() ?>
                                        @foreach($taxes as $tax )
                                        <option value="{{$tax->rate}}" {{$item->tax == $tax->rate ? 'selected' : ''}}>{{$tax->abbreviation}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                <td class="text-right">
                                    &#8377; <span class="totAmount"> {{$item->product_tot_amt}}</span>
                                    <input type="hidden" name="product_tot_amt[]" value="{{$item->product_tot_amt}}">
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn-removeItem"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="javascript:;" class="text-primary btn-addMoreItems s ml-4 mb-2">Add more item</a>
                </div>
               <hr class="mt-0 mb-0">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 subTotalAmount">
                        &#8377; <span class="subTotAmount font-weight-bold"> {{$invoice->sub_tot_amt}}</span>
                        <input type="hidden" name="sub_tot_amt" value="{{$invoice->sub_tot_amt}}">
                    </div>
                    <div class="p-2 text-right subTotalAmount font-weight-bold">Subtotal :</div>
                </div>
                @if(!auth()->user()->taxmode && isset($invoice->taxes))
                    @foreach($invoice->taxes as $tax)
                    <div class="d-flex flex-row-reverse oldTax">
                        <div class="p-2 px-3"></div>
                        <?php $key = key($tax); ?>
                        <div class="p-2 taxAmount">
                            {{ $tax->$key  }}
                        </div>
                        <input type="hidden" name="old_tax_amt[]" value="{{ $tax->$key }}">
                        <input type="hidden" name="old_tax_abbrivation[]" value="{{ key($tax)  }}" >
                        <div class="p-2 text-right font-weight-bold">{{ key($tax) }} :</div>
                    </div>
                    @endforeach
                @endif
                @if(!auth()->user()->taxmode)
                @foreach($invoicetaxes as $tax)
                <div class="d-flex flex-row-reverse newTax" style="display: none !important;">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 taxAmount{{$tax->id}}">
                        0
                    </div>
                    <input type="hidden" name="tax_amt[]" class="inputTaxAmount{{$tax->id}}" value="0">
                    <input type="hidden" name="tax_abbrivation[]" value="{{$tax->abbreviation}}" class="inputTaxAbbrivation{{$tax->id}}">
                    <div class="p-2 text-right font-weight-bold">{{$tax->abbreviation}} :</div>
                </div>
                @endforeach
                @endif
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        <select name="discount_type"  style="width: 80px">
                            <option value="0" {{$invoice->discount_type == 0 ? 'selected' : ''}}>Fixed</option>
                            <option value="1" {{$invoice->discount_type == 1 ? 'selected' : ''}}>Percentage</option>
                        </select>
                        <input type="number" name="discount" value="{{$invoice->discount}}" class="text-right" style="width: 80px">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Discount :</div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 grandTotalAmount">
                        &#8377; <span class="grandTotAmount font-weight-bold"> {{$invoice->grand_total}}</span>
                        <input type="hidden" name="grand_total" value="{{$invoice->grand_total}}">
                        <input type="hidden" name="temp_grand_total" value="{{$invoice->grand_total}}">
                    </div>
                    <div class="p-2 text-right grandTotalAmount font-weight-bold">Total (INR) :</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@include('sales.invoices.partials.modals')
@include('components.modals.comman')
@endsection

@push('js')
<script type="text/javascript">
    $('.table-invoiceItems').on('change', '.select-product', function(){
        $('.oldTax').attr("style", "display: none !important");
        $('.newTax').show();
        var productId = $(this).val();
        var row = $(this).parents('tr');
        row.find('.input-qty').val(1);
        row.find('.select-tax').val(0);
        row.find('[name="description[]"]').val('');
        $('[name="discount"]').val(0);
        axios.get('/products/'+ productId + '/get')
        .then(function (response) {
            // console.log(response);
            row.find('.input-price').val(response.data.selling_price);
            row.find('.totAmount').html(response.data.selling_price);
            row.find('[name="product_tot_amt[]"]').val(response.data.selling_price);

            @if(auth()->user()->taxmode)
            row.find('.select-tax').val(response.data.tax);
            var tax = response.data.tax;
            @else
            row.find('.select-tax').val(0);
            var tax = 0;
            @endif

            var qty = parseFloat(row.find('.input-qty').val());
            var price = response.data.selling_price;
            var noTaxAmt = price * qty;
            var taxAmt = ((noTaxAmt * tax) / 100);
            row.find('.totAmount').html(noTaxAmt + taxAmt);
            row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);

            total();
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    $('.table-invoiceItems').on('keyup', '.input-qty', function(){
        $('.oldTax').attr("style", "display: none !important");
        $('.newTax').show();
        var row = $(this).parents('tr');
        var qty = parseFloat($(this).val());
        var price = parseFloat(row.find('.input-price').val());
        var tax = parseFloat(row.find('.select-tax').val());

        var productId = row.find('.select-product').val();
        $('[name="discount"]').val(0);

        axios.get('/products/'+ productId + '/get')
        .then(function (response) {
            console.log(response);
            if (response.data.stock >= qty) {
                var noTaxAmt = price * qty;
                if (!tax) {
                    tax = 0;
                }
                var taxAmt = ((noTaxAmt * tax) / 100);
                row.find('.totAmount').html(noTaxAmt + taxAmt);
                row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
                total();
            }else{
                alert('Available stock is : '+response.data.stock);
                row.find('.input-qty').val(1);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    $('.table-invoiceItems').on('keyup', '.input-price', function(){
        $('.oldTax').attr("style", "display: none !important");
        $('.newTax').show();
        var row = $(this).parents('tr');
        var price = parseFloat($(this).val());
        var qty = parseFloat(row.find('.input-qty').val());
        var tax = parseFloat(row.find('.select-tax').val());
        if(!tax){
            tax = 0;
        }
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-invoiceItems').on('change', '.select-tax', function(){
        var row = $(this).parents('tr');
        var tax = $(this).val();
        var qty = parseFloat(row.find('.input-qty').val());
        var price = parseFloat(row.find('.input-price').val());
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    var grandTotal = $('[name="grand_total"]').val();

    $('[name="discount"]').on('keyup change', function(){
        $('.oldTax').attr("style", "display: none !important");
        $('.newTax').show();
        var subTotal = parseFloat($('[name="sub_tot_amt"]').val());
        var tempGrandTotal = parseFloat($('[name="temp_grand_total"]').val());
        var discountType = $('[name="discount_type"]').val();
        var discount = parseFloat($(this).val());
        if(!discount){
            discount = 0;
        }
        totamt = 0;
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            discountTotal = subTotal - discountVal;
            $("input[name='grand_total']").val(tempGrandTotal - discountVal);
            $(".grandTotAmount").html(tempGrandTotal - discountVal);
        }else{
            totamt = subTotal - discount;
            $("input[name='grand_total']").val(tempGrandTotal - discount);
            $(".grandTotAmount").html(tempGrandTotal - discount);
        }
    });

    $('[name="discount_type"]').on('change', function(){
        $('.oldTax').attr("style", "display: none !important");
        $('.newTax').show();
        $('[name="discount"]').val(0);
        var subTotal = parseFloat($('[name="sub_tot_amt"]').val());
        var tempGrandTotal = parseFloat($('[name="temp_grand_total"]').val());
        var discountType = parseFloat($(this).val());
        var discount = 0;
        totamt = 0;
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            discountTotal = subTotal - discountVal;
            $("input[name='grand_total']").val(tempGrandTotal - discountVal);
            $(".grandTotAmount").html(tempGrandTotal - discountVal);
        }else{
            totamt = subTotal - discount;
            $("input[name='grand_total']").val(tempGrandTotal - discount);
            $(".grandTotAmount").html(tempGrandTotal - discount);
        }
    });

    $('.table-invoiceItems').on('click', '.btn-removeItem', function(){
        var row = $(this).parents('tr');
        row.remove();
        total();
    });

    $('.btn-addMoreItems').on('click', function(){
        var html = '<tr><td>\
        <select class="form-control form-control-sm select-product selectCustomer" name="product_id[]" style="width: 180px">\
        <option selected disabled>-- Choose Product --</option>\
        @foreach($products as $product)\
        <option value="{{$product->id}}">{{$product->name}} ({{$product->product_code}})</option>\
        @endforeach\
        </select></td>\
        <td>\
        <textarea class="form-control" name="description[]" style="width: 150px"></textarea>\
        </td>\
        <td>\
        <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty">\
        </td>\
        <td>\
        <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price">\
        </td>\
        @if(auth()->user()->taxmode)\
        <td>\
        <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">\
        <option selected disabled>-- Choose Tax --</option>\
        <option value="0">None</option>\
        <?php $taxes = getTaxes() ?>\
        @foreach($taxes as $tax )\
        <option value="{{$tax->rate}}">{{$tax->abbreviation}}</option>\
        @endforeach\
        </select>\
        </td>\
        @endif\
        <td class="text-right">\
        &#8377; <span class="totAmount"> 0.00</span>\
        <input type="hidden" name="product_tot_amt[]" value="0">\
        </td>\
        <td>\
        <a href="javascript:;" class="btn-removeItem"><i class="fa fa-trash"></i></a>\
        </td></tr>';

        $('.table-invoiceItems .tableBodyItems').append(html);
        $('.table-invoiceItems .select-product').select2()
        .on('select2:open', (e) => {
            window.selectedBox = $(e.currentTarget);
            $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
        });
    });

    function total(){
        var totamt = 0 ;
        var theTbl = $('.table-invoiceItems');
        var trs = theTbl.find("input[name='product_tot_amt[]']");
        for(var i=0;i<trs.length;i++)
        {
            $(".subTotAmount").html(totamt+=parseFloat(trs[i].value));
            $("input[name='sub_tot_amt']").val(totamt);
            $("input[name='grand_total']").val(totamt);
            $("input[name='temp_grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }
        grandTotal = totamt;

        var subTotal = parseFloat($('[name="sub_tot_amt"]').val());
        var tempGrandTotal = parseFloat($('[name="temp_grand_total"]').val());
        var discountType = $('[name="discount_type"]').val();
        var discount = parseFloat($('[name="discount"]').val());
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            totamt = subTotal - discountVal;
            $("input[name='grand_total']").val(tempGrandTotal - discountVal);
            $(".grandTotAmount").html(tempGrandTotal - discountVal);
        }else{
            totamt = subTotal - discount;
            $("input[name='grand_total']").val(tempGrandTotal - discount);
            $(".grandTotAmount").html(tempGrandTotal - discount);
        }

        var invoiceTotTaxAmt = 0;
        @if(!auth()->user()->taxmode)
        @foreach($invoicetaxes as $tax)
            var invoiceTaxAmt = ((subTotal * {{$tax->rate}}) / 100);
            invoiceTotTaxAmt += invoiceTaxAmt;

            $('.taxAmount{{$tax->id}}').html(invoiceTaxAmt);
            $('.inputTaxAmount{{$tax->id}}').val(invoiceTaxAmt);
            $("input[name='grand_total']").val(subTotal + invoiceTotTaxAmt);
            $("input[name='temp_grand_total']").val(subTotal + invoiceTotTaxAmt);
            $(".grandTotAmount").html(subTotal + invoiceTotTaxAmt);
        @endforeach
        @endif
    }

    $('.selectCustomer').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addCustomerModal" data-toggle="modal" onclick="closeSelect2(this, \'selectCustomer\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new customer</a>');
    });

    $('.selectEmployee').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addEmployeeModal" data-toggle="modal" onclick="closeSelect2(\'selectEmployee\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new salesman</a>');
    });

    $('.table-invoiceItems .select-product').select2()
    .on('select2:open', (e) => {
        window.selectedBox = $(e.currentTarget);
        $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
    });

</script>
@endpush