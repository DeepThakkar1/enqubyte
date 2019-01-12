@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"> <a href="/enquiries" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a> Edit Enquiry</h2>
        <div class="float-right">
            @if(!$enquiry->status == 1 && !$enquiry->status == -1)
            <a href="/enquiries/{{$enquiry->id}}/cancel" class="btn btn-outline-danger" title="Cancel Enquiry">Cancel Enquiry</a>
            @endif
            @if(!$enquiry->status == 1)
            <a href="/enquiries/{{$enquiry->id}}/invoice" class="btn btn-primary" title="Convert to Invoice">Convert to Invoice</a>
            @else
            <a href="javascript:;" class="btn btn-primary disabled"  title="Convert to Invoice">Convert to Invoice</a>
            @endif
        </div>
        <!-- <a href="/enquiries" class="btn btn-secondary float-right">Back</a> -->
    </div>
    <!-- <hr> -->
    <div class="card">
        <form method="post" action="/enquiries/{{$enquiry->id}}/update">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label>Enquiry Number</label>
                        <input type="text" name="" class="form-control" value="{{$enquiry->sr_no}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Customer</label>
                        <select class="form-control selectCustomer" name="customer_id" required>
                            <option selected disabled>-- Choose Customer --</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{$enquiry->customer_id == $customer->id ? 'selected' : ''}}>{{$customer->fullname}} ({{$customer->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Salesman</label>
                        <select class="form-control selectWithSearch selectEmployee" name="employee_id">
                            <option selected disabled>-- Choose Salesman --</option>
                            @foreach($salesmans as $salesman)
                            <option value="{{$salesman->id}}" {{$enquiry->employee_id == $salesman->id ? 'selected' : ''}}>{{$salesman->fullname}} ({{$salesman->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="enquiry_date" value="{{$enquiry->enquiry_date}}" placeholder="Enquiry date" required>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Follow Up Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="followup_date" value="{{$enquiry->followup_date}}" placeholder="Enquiry followup date">
                    </div>
                </div>
                <hr>
                <div class="table-responsive" style="position: relative;">
                    <table class="table table-enquiryItems m-0">
                        <thead>
                            <tr class="product-list-menu">
                                <th>Items</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Tax</th>
                                <th class="text-right">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="tableBodyItems">
                            @foreach($enquiryitems as $item)
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px" required>
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
                                <td>
                                    <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">
                                        <option selected disabled>-- Choose Tax --</option>
                                        <option value="0" {{$item->tax == 0 ? 'selected' : ''}}>None</option>
                                        <?php $taxes = getTaxes() ?>
                                        @foreach($taxes as $tax )
                                        <option value="{{$tax->rate}}" {{isset($item->tax) && $item->tax == $tax->rate ? 'selected' : ''}}>{{$tax->abbreviation}}</option>
                                        @endforeach
                                    </select>
                                </td>
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
                    <a href="javascript:;" class="text-primary btn-addMoreItems">Add more item</a>
                </div>

                <hr>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        &#8377; <span class="subTotAmount font-weight-bold"> {{$enquiry->sub_tot_amt}}</span>
                        <input type="hidden" name="sub_tot_amt" value="{{$enquiry->sub_tot_amt}}">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Subtotal :</div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        <select name="discount_type"  style="width: 80px">
                            <option value="0" {{$enquiry->discount_type == 0 ? 'selected' : ''}}>Fixed</option>
                            <option value="1" {{$enquiry->discount_type == 1 ? 'selected' : ''}}>Percentage</option>
                        </select>
                        <input type="number" name="discount" value="{{$enquiry->discount}}" class="text-right" style="width: 80px">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Discount :</div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        &#8377; <span class="grandTotAmount font-weight-bold"> {{$enquiry->grand_total}}</span>
                        <input type="hidden" name="grand_total" value="{{$enquiry->grand_total}}">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Total (INR) :</div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@include('enquiries.partials.modals')

@endsection

@push('js')
<script type="text/javascript">
    $('.table-enquiryItems').on('change', '.select-product', function(){
        var productId = $(this).val();
        var row = $(this).parents('tr');
        row.find('.input-qty').val(1);
        row.find('.select-tax').val(0);
        row.find('[name="description[]"]').val('');

        axios.get('/products/'+ productId + '/get')
        .then(function (response) {
            // console.log(response);
            row.find('.input-price').val(response.data.selling_price);
            row.find('.totAmount').html(response.data.selling_price);
            row.find('[name="product_tot_amt[]"]').val(response.data.selling_price);

            var tax = response.data.tax;
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
        var qty = $(this).val();
        var price = row.find('.input-price').val();
        var tax = row.find('.select-tax').val();
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-enquiryItems').on('keyup', '.input-price', function(){
        var row = $(this).parents('tr');
        var price = $(this).val();
        var qty = row.find('.input-qty').val();
        var tax = row.find('.select-tax').val();
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-enquiryItems').on('change', '.select-tax', function(){
        var row = $(this).parents('tr');
        var tax = $(this).val();
        var qty = row.find('.input-qty').val();
        var price = row.find('.input-price').val();
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    var grandTotal = $('[name="grand_total"]').val();
    $('[name="discount"]').on('keyup', function(){
        var subTotal = $('[name="sub_tot_amt"]').val();
        var discountType = $('[name="discount_type"]').val();
        var discount = $(this).val();
        totamt = 0;
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            totamt = subTotal - discountVal;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }else{
            totamt = subTotal - discount;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }
    });

    $('[name="discount_type"]').on('change', function(){
        $('[name="discount"]').val(0);
        var subTotal = $('[name="sub_tot_amt"]').val();
        var discountType = $(this).val();
        var discount = 0;
        totamt = 0;
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            totamt = subTotal - discountVal;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }else{
            totamt = subTotal - discount;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }
    });


    $('.table-enquiryItems').on('click', '.btn-removeItem', function(){
        var row = $(this).parents('tr');
        row.remove();
        total();

        var subTotal = $('[name="sub_tot_amt"]').val();
        var discountType = $('[name="discount_type"]').val();
        var discount = $('[name="discount"]').val();
        totamt = 0;
        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            totamt = grandTotal - discountVal;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }else{
            totamt = grandTotal - discount;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }
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
        <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty">\
        </td>\
        <td>\
        <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price">\
        </td>\
        <td>\
        <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">\
        <option selected disabled>-- Choose Tax --</option>\
        <option value="0">None</option>\
        <?php $taxes = getTaxes() ?>
        @foreach($taxes as $tax )\
        <option value="{{$tax->rate}}">{{$tax->abbreviation}}</option>\
        @endforeach\
        </select>\
        </td>\
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
            $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
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
            $(".grandTotAmount").html(totamt);
        }

        grandTotal = totamt;

        var subTotal = $('[name="sub_tot_amt"]').val();
        var discountType = $('[name="discount_type"]').val();
        var discount = $('[name="discount"]').val();

        if(discountType == 1){
            discountVal = (subTotal * discount) / 100;
            totamt = grandTotal - discountVal;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }else{
            totamt = grandTotal - discount;
            $("input[name='grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }
    }

    $('.selectCustomer').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addCustomerModal" data-toggle="modal" onclick="closeSelect2(\'selectCustomer\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new customer</a>');
    });

    $('.select-product').select2()
    .on('select2:open', (e) => {
        window.selectedBox = $(e.currentTarget);
        $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
    });

    $('.selectEmployee').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addEmployeeModal" data-toggle="modal" onclick="closeSelect2(\'selectEmployee\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new salesman</a>');
    });

</script>
@endpush