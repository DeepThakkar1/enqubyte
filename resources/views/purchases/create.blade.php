@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Add Purchase Order</h2>
        <a href="/purchases" class="btn btn-secondary custom-back-btn float-right">Back</a>
    </div>
    <div class="card border-top-0">
        <form method="post" action="/purchases" enctype="multipart/form-data">
            @csrf
            <div class="card-body p-0">
                <div class="row pl-0 pt-4 m-0">
                    <div class="col-sm-4 form-group">
                        <label>Sr.No</label>
                        <input type="text" name="sr_no" class="form-control" value="{{$purchaseSrno}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Purchase Bill Number</label>
                        <input type="text" class="form-control" name="order_id" placeholder="Purchase Order Number">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Vendor<sup class="error">*</sup></label>
                        <select class="form-control selectWithSearch selectVendor" name="vendor_id" required>
                            <option selected disabled>-- Choose Vendor --</option>
                            @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->name}} ({{$vendor->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Date<sup class="error">*</sup></label>
                        <input type="text" class="form-control startDatepicker" autocomplete="off" required name="purchase_date" placeholder="Purchase Order date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Due Date<sup class="error">*</sup></label>
                        <input type="text" class="form-control endDatepicker" autocomplete="off" required name="due_date" placeholder="Due date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <div class="uploadButton responsive-uploadButton-purchase">
                            <label for="uploadPurchaseOrder" class="uploadButton-button">Purchase Order Scan Copy</label>
                            <input type="file" id="uploadPurchaseOrder" class="form-control uploadButton-input custom-uploadButton-input" name="order_scan_copy">
                            <span class="uploadButton-file-name">Click to upload</span>
                            <p class="m-0 text-muted"><small>(eg: .png, .jpeg, .jpg, .png, .pdf)</small></p>
                        </div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="table-responsive m-0" style="position: relative;">
                    <table class="table table-purchaseItems">
                        <thead>
                            <tr class="product-list-menu">
                                <th>Items</th>
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
                                    <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px"  required>
                                        <option selected disabled>-- Choose Product --</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}} ({{$product->product_code}})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty">
                                </td>
                                <td>
                                    <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price">
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
                    <input type="hidden" name="tax_amt[]" class="inputTaxAmount{{$tax->id}}" value="0">
                    <input type="hidden" name="tax_abbrivation[]" value="{{$tax->abbreviation}}" class="inputTaxAbbrivation{{$tax->id}}">
                    <div class="p-2 text-right font-weight-bold">{{$tax->abbreviation}} :</div>
                </div>
                @endforeach
                @endif
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2 grandTotalAmount">
                        &#8377; <span class="grandTotAmount font-weight-bold"> 0.00</span>
                        <input type="hidden" name="grand_total" value="0">
                        <input type="hidden" name="temp_grand_total" value="0">
                    </div>
                    <div class="p-2 text-right grandTotalAmount font-weight-bold">Total (INR) :</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@include('purchases.partials.modals')
@include('components.modals.comman')

@endsection

@push('js')
<script type="text/javascript">
    $('.table-purchaseItems').on('change', '.select-product', function(){
        var productId = $(this).val();
        var row = $(this).parents('tr');
        axios.get('/products/'+ productId + '/get')
        .then(function (response) {
            // console.log(response);
            row.find('.input-price').val(response.data.cost_price);
            row.find('.totAmount').html(response.data.cost_price);
            row.find('[name="product_tot_amt[]"]').val(response.data.cost_price);

            @if(auth()->user()->taxmode)
            row.find('.select-tax').val(response.data.tax);
            var tax = response.data.tax;
            @else
            row.find('.select-tax').val(0);
            var tax = 0;
            @endif

            var qty = row.find('.input-qty').val();
            var price = response.data.cost_price;
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

    $('.table-purchaseItems').on('keyup', '.input-qty', function(){
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

    $('.table-purchaseItems').on('keyup', '.input-price', function(){
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

    $('.table-purchaseItems').on('change', '.select-tax', function(){
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

    $('.table-purchaseItems').on('click', '.btn-removeItem', function(){
        var row = $(this).parents('tr');
        row.remove();
        total();
    });

    $('.btn-addMoreItems').on('click', function(){
        var html = '<tr><td>\
            <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px">\
            <option selected disabled>-- Choose Product --</option>\
            @foreach($products as $product)\
            <option value="{{$product->id}}">{{$product->name}} ({{$product->product_code}})</option>\
            @endforeach\
            </select></td>\
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

        $('.table-purchaseItems .tableBodyItems').append(html);
        $('.table-purchaseItems .select-product').select2()
        .on('select2:open', (e) => {
            window.selectedBox = $(e.currentTarget);
            $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
        });
    });

    function total(){
        var totamt = 0 ;
        var theTbl = $('.table-purchaseItems');
        var trs = theTbl.find("input[name='product_tot_amt[]']");
        for(var i=0;i<trs.length;i++)
        {
            $(".subTotAmount").html(totamt+=parseFloat(trs[i].value));
            $("input[name='sub_tot_amt']").val(totamt);
            $("input[name='grand_total']").val(totamt);
            $("input[name='temp_grand_total']").val(totamt);
            $(".grandTotAmount").html(totamt);
        }

        var subTotal = parseFloat($('[name="sub_tot_amt"]').val());
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

    $('.selectVendor').select2()
    .on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#addVendorModal" data-toggle="modal" onclick="closeSelect2(\'selectVendor\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new vendor</a>');
    });

    $('.table-purchaseItems .select-product').select2()
        .on('select2:open', (e) => {
            window.selectedBox = $(e.currentTarget);
            $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
    });

</script>
@endpush