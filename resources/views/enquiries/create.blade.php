@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"> <a href="/enquiries" class="mr-1"><i class="fa fa-arrow-left"></i></a> Add Enquiry</h2>
        <!-- <a href="/enquiries" class="btn btn-secondary float-right">Back</a> -->
    </div>
    <div class="card border-top-0">
        <form method="post" action="/enquiries">
            @csrf
            <div class="card-body p-0">
                <div class="row pl-0 py-4 m-0">
                    <div class="col-sm-4 form-group">
                        <label>Enquiry Number</label>
                        <input type="text" name="sr_no" class="form-control" value="{{$enquirySrno}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Customer<sup class="error">*</sup></label>
                        <select class="form-control selectWithSearch selectCustomer" name="customer_id" required>
                            <option selected disabled>-- Choose Customer --</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->fullname}} ({{$customer->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Salesman</label>
                        <select class="form-control selectWithSearch selectEmployee" name="employee_id">
                            <option selected disabled>-- Choose Salesman --</option>
                            <option value="0">None</option>
                            @foreach($salesmans as $salesman)
                            <option value="{{$salesman->id}}">{{$salesman->fullname}} ({{$salesman->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Date<sup class="error">*</sup></label>
                        <input type="text" class="form-control datepicker" name="enquiry_date" autocomplete="off" placeholder="Enquiry date" required>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Follow Up Date</label>
                        <input type="text" class="form-control enddatepicker" name="followup_date" autocomplete="off" placeholder="Enquiry followup date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Follow Up Time</label>
                        <input type="text" class="form-control timepicker" name="followup_time" autocomplete="off" placeholder="Enquiry followup time">
                    </div>
                </div>
                <!-- <hr> -->
                <div class="table-responsive m-0" style="position: relative;">
                    <table class="table table-enquiryItems">
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
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px" required>
                                        <option selected disabled>-- Choose Product --</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}} ({{$product->product_code}})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" style="width: 150px"></textarea>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty" required>
                                </td>
                                <td>
                                    <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price" required>
                                </td>
                                @if(auth()->user()->taxmode)
                                <td>
                                    <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">
                                        <option selected disabled>-- Choose Tax --</option>
                                        <option value="0">None</option>
                                        <?php $taxes = getTaxes() ?>
                                        @foreach($taxes as $tax )
                                        <option value="{{$tax->rate}}">{{$tax->abbreviation}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                <td class="text-right">
                                    &#8377; <span class="totAmount"> 0.00</span>
                                    <input type="hidden" name="product_tot_amt[]" value="0">
                                </td>
                                <td>
                                    <!-- <a href="javascript:;" class="btn-removeItem"><i class="fa fa-trash"></i></a> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="javascript:;" class="text-primary btn-addMoreItems ml-4 mb-2">Add more item</a>
                </div>

                <hr class="mt-0 mb-0">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 subTotalAmount">
                        &#8377; <span class="subTotAmount font-weight-bold"> 0.00</span>
                        <input type="hidden" name="sub_tot_amt" value="0">
                    </div>
                    <div class="p-2 text-right subTotalAmount font-weight-bold">Subtotal :</div>
                </div>
                @if(!auth()->user()->taxmode)
                @foreach($invoicetaxes as $tax)
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 taxAmount{{$tax->id}}">
                        0
                    </div>
                    <div class="p-2 text-right font-weight-bold">{{$tax->abbreviation}} :</div>
                </div>
                @endforeach
                @endif
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        <select name="discount_type"  style="width: 80px">
                            <option value="0">Fixed</option>
                            <option value="1">Percentage</option>
                        </select>
                        <input type="number" name="discount" class="text-right" style="width: 80px">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Discount :</div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 grandTotalAmount">
                        &#8377; <span class="grandTotAmount font-weight-bold"> 0.00</span>
                        <input type="hidden" name="grand_total" value="0">
                        <input type="hidden" name="temp_grand_total" value="0">
                    </div>
                    <div class="p-2 text-right font-weight-bold grandTotalAmount">Total (INR) :</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@include('components.modals.comman')

@endsection

@push('js')
<script type="text/javascript">
    $('.table-enquiryItems').on('change', '.select-product', function(){
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

            var qty = row.find('.input-qty').val();
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

    $('.table-enquiryItems').on('keyup', '.input-qty', function(){
        var row = $(this).parents('tr');
        var qty = parseFloat($(this).val());
        var price = parseFloat(row.find('.input-price').val());
        var tax = row.find('.select-tax').val();
        $('[name="discount"]').val(0);
        var noTaxAmt = price * qty;
        if (!tax) {
            tax = 0;
        }
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-enquiryItems').on('keyup', '.input-price', function(){
        var row = $(this).parents('tr');
        var price = parseFloat($(this).val());
        var qty = parseFloat(row.find('.input-qty').val());
        var tax = parseFloat(row.find('.select-tax').val());
        $('[name="discount"]').val(0);
        if(!tax){
            tax = 0;
        }
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-enquiryItems').on('change', '.select-tax', function(){
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

    var grandTotal = 0;
    $('[name="discount"]').on('keyup change', function(){
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
        $('[name="discount"]').val(0);
        var subTotal = parseFloat($('[name="sub_tot_amt"]').val());
        var tempGrandTotal = parseFloat($('[name="temp_grand_total"]').val());
        var discountType = $(this).val();
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

    $('.table-enquiryItems').on('click', '.btn-removeItem', function(){
        var row = $(this).parents('tr');
        row.remove();
        total();
    });

    $('.btn-addMoreItems').on('click', function(){
        var html = '<tr><td>\
        <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px" required>\
        <option selected disabled>-- Choose Product --</option>\
        @foreach($products as $product)\
        <option value="{{$product->id}}">{{$product->name}} ({{$product->product_code}})</option>\
        @endforeach\
        </select></td>\
        <td>\
        <textarea class="form-control" name="description[]" style="width: 150px"></textarea>\
        </td>\
        <td>\
        <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty" required>\
        </td>\
        <td>\
        <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price" required>\
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

        $('.table-enquiryItems .tableBodyItems').append(html);
        $('.table-enquiryItems .select-product').select2()
        .on('select2:open', (e) => {
            window.selectedBox = $(e.currentTarget);
            $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal"  onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
        });
    });

    function total(){
        var totamt = 0 ;
        var theTbl = $('.table-enquiryItems');
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
            $("input[name='temp_grand_total']").val(tempGrandTotal - discountVal);
            $(".grandTotAmount").html(tempGrandTotal - discountVal);
        }else{
            totamt = grandTotal - discount;
            $("input[name='grand_total']").val(tempGrandTotal - discount);
            $("input[name='temp_grand_total']").val(tempGrandTotal - discount);
            $(".grandTotAmount").html(tempGrandTotal - discount);
        }
        var invoiceTotTaxAmt = 0;
        @if(!auth()->user()->taxmode)
        @foreach($invoicetaxes as $tax)
            var invoiceTaxAmt = ((subTotal * {{$tax->rate}}) / 100);
            invoiceTotTaxAmt += invoiceTaxAmt;

            $('.taxAmount{{$tax->id}}').html(invoiceTaxAmt);
            $("input[name='grand_total']").val(subTotal + invoiceTotTaxAmt);
            $("input[name='temp_grand_total']").val(subTotal + invoiceTotTaxAmt);
            $(".grandTotAmount").html(subTotal + invoiceTotTaxAmt);
        @endforeach
        @endif
    }

    $('.selectCustomer').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addCustomerModal" data-toggle="modal" onclick="closeSelect2(\'selectCustomer\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new customer</a>');
    });

    $('.selectEmployee').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addEmployeeModal" data-toggle="modal" onclick="closeSelect2(\'selectEmployee\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new salesman</a>');
    });

    $('.select-product').select2()
    .on('select2:open', (e) => {
        window.selectedBox = $(e.currentTarget);
        $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal"  onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
    });


</script>
@endpush