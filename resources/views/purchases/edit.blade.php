@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Edit Purchase Order</h2>
        <a href="/purchases" class="btn btn-secondary float-right">Back</a>
    </div>
    <!-- <hr> -->
    <div class="card">
        <form method="post" action="/purchases/{{$purchaseOrder->id}}/update" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label>Sr.No</label>
                        <input type="text" class="form-control" value="{{$purchaseOrder->sr_no}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Purchase Order Number</label>
                        <input type="text" name="order_id" class="form-control" value="{{$purchaseOrder->order_id}}">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Vendor<sup class="error">*</sup></label>
                        <select class="form-control selectWithSearch selectVendor" name="vendor_id" required>
                            <option selected disabled>-- Choose Vendor --</option>
                            @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}" {{$purchaseOrder->vendor_id == $vendor->id ? 'selected' : ''}}>{{$vendor->name}} ({{$vendor->phone}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>Date<sup class="error">*</sup></label>
                        <input type="text" class="form-control datepicker" autocomplete="off" required name="purchase_date" value="{{$purchaseOrder->purchase_date}}" placeholder="Invoice date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Due Date<sup class="error">*</sup></label>
                        <input type="text" class="form-control datepicker" autocomplete="off" required name="due_date" value="{{$purchaseOrder->due_date}}" placeholder="Due date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Purchase Order Scan Copy (Optional)</label>
                        <input type="file" class="form-control" name="order_scan_copy">
                        <p class="m-0 text-muted"><small>(eg: .png, .jpeg, .jpg, .png, .pdf)</small></p>
                    </div>
                </div>
                <hr>
                <div class="table-responsive m-0" style="position: relative;">
                    <table class="table table-purchaseItems">
                        <thead>
                            <tr class="product-list-menu">
                                <th>Items</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Tax</th>
                                <th class="text-right">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="tableBodyItems">
                            @foreach($purchaseitems as $item)
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
                                            <option value="{{$tax->rate}}" {{$item->tax == $tax->rate ? 'selected' : ''}}>{{$tax->abbreviation}}</option>
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
                        &#8377; <span class="subTotAmount font-weight-bold"> {{$purchaseOrder->sub_tot_amt}}</span>
                        <input type="hidden" name="sub_tot_amt" value="{{$purchaseOrder->sub_tot_amt}}">
                    </div>
                    <div class="p-2 text-right font-weight-bold">Subtotal :</div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 px-3"></div>
                    <div class="p-2">
                        &#8377; <span class="grandTotAmount font-weight-bold"> {{$purchaseOrder->grand_total}}</span>
                        <input type="hidden" name="grand_total" value="{{$purchaseOrder->grand_total}}">
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

@include('purchases.partials.modals')

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

            row.find('.select-tax').val(response.data.tax);

            var tax = response.data.tax;
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
        var qty = $(this).val();
        var price = row.find('.input-price').val();
        var tax = row.find('.select-tax').val();
        var noTaxAmt = price * qty;
        var taxAmt = ((noTaxAmt * tax) / 100);
        row.find('.totAmount').html(noTaxAmt + taxAmt);
        row.find('[name="product_tot_amt[]"]').val(noTaxAmt + taxAmt);
        total();
    });

    $('.table-purchaseItems').on('keyup', '.input-price', function(){
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

    $('.table-purchaseItems').on('change', '.select-tax', function(){
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

    $('.table-purchaseItems').on('click', '.btn-removeItem', function(){
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
            <input type="text" name="qty[]" style="width: 80px" value="1" class="form-control form-control-sm input-qty">\
            </td>\
            <td>\
            <input type="text" name="price[]" style="width: 120px" value="0" class="form-control form-control-sm input-price">\
            </td>\
            <td>\
            <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">\
            <option selected disabled>-- Choose Tax --</option>\
            <option value="0">None</option>\
            <?php $taxes = getTaxes() ?>\
            @foreach($taxes as $tax )\
            <option value="{{$tax->rate}}" {{$item->tax == $tax->rate ? "selected" : ""}}>{{$tax->abbreviation}}</option>\
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
        $(".grandTotAmount").html(totamt);
    }
}

$('.selectCustomer').select2()
.on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="#addCustomerModal" data-toggle="modal" onclick="closeSelect2(this, \'selectCustomer\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new customer</a>');
});

$('.table-purchaseItems .select-product').select2()
    .on('select2:open', (e) => {
        window.selectedBox = $(e.currentTarget);
        $(".select2-results:not(:has(a))").append('<a href="#addProductModal" data-toggle="modal" onclick="closeMultipleSelect2(this, \'select-product\')" class="select2-additem"><i class="fa fa-plus-circle"></i> Add new product</a>');
    });

</script>
@endpush