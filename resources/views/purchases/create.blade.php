@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Add Purchase Order</h2>
        <a href="/purchases" class="btn btn-secondary float-right">Back</a>
    </div>
    <div class="card">
        <form method="post" action="/purchases">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label>Sr.No</label>
                        <input type="text" class="form-control" value="{{isset($purchase->id) ? $purchase->id + 1 : 1}}" readonly>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Purchase Order Number</label>
                        <input type="text" class="form-control" name="order_id" placeholder="Purchase Order Number">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Vendor</label>
                        <select class="form-control selectWithSearch selectVendor" name="vendor_id">
                            <option selected disabled>-- Choose Vendor --</option>
                            @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->name}} ({{$vendor->phone}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="purchase_date" placeholder="Purchase Order date">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Due Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="due_date" placeholder="Due date">
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
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
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm select-product selectWithSearch" name="product_id[]" style="width: 180px">
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
                                <td>
                                    <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">
                                        <option selected disabled>-- Choose Tax --</option>
                                        <option value="0">None</option>
                                        <option value="2">2%</option>
                                        <option value="3">3%</option>
                                        <option value="5">5%</option>
                                        <option value="12">12%</option>
                                    </select>
                                </td>
                                <td class="text-right">
                                    &#8377; <span class="totAmount"> 0.00</span>
                                    <input type="hidden" name="product_tot_amt[]" value="0">
                                </td>
                                <td>
                                    <!-- <a href="javascript:;" class="btn-removeItem"><i class="fa fa-trash"></i></a> -->
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right font-weight-bold">Subtotal : </td>
                                <td class="text-right font-weight-bold">
                                    &#8377; <span class="subTotAmount"> 0.00</span>
                                    <input type="hidden" name="sub_tot_amt" value="0">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right font-weight-bold">Total (INR): </td>
                                <td class="text-right font-weight-bold">
                                    &#8377; <span class="grandTotAmount"> 0.00</span>
                                    <input type="hidden" name="grand_total" value="0">
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="javascript:;" class="text-primary btn-addMoreItems">Add more item</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
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
            <td>\
            <select class="form-control form-control-sm select-tax" name="tax[]"  style="width: 150px">\
            <option selected disabled>-- Choose Tax --</option>\
            <option value="0">None</option>\
            <option value="2">2%</option>\
            <option value="3">3%</option>\
            <option value="5">5%</option>\
            <option value="12">12%</option>\
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