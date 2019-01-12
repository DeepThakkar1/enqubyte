<div class="modal fade in addCustomerModal" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmCustomer">
                @csrf
                <div class="modal-body">
                    <p class="errorCustomer error" style="display: none;">Fill all required fields.</p>
                    @if(auth()->user()->mode)
                    <div class="form-group">
                        <label>Store<sup class="error">*</sup></label>
                        <select name="store_id" class="form-control" required>
                            <option disabled selected>-- Select Store --</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="store_id" value="0">
                    @endif
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>First Name<sup class="error">*</sup></label>
                            <input type="text" name="fname" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Last Name<sup class="error">*</sup></label>
                            <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Customer email">
                        </div>
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="addCustomer" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in addProductModal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmProduct">
                @csrf
                <div class="modal-body">
                    <p class="errorProduct error" style="display: none;">Fill all required fields.</p>
                    @if(auth()->user()->mode)
                    <div class="form-group">
                        <label>Store<sup class="error">*</sup></label>
                        <select name="store_id" class="form-control" required>
                            <option disabled selected>-- Select Store --</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Product Name<sup class="error">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Product name" required>
                    </div>
                    <div class="form-group">
                        <label>Description<sup class="error">*</sup></label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Selling Price<sup class="error">*</sup></label>
                            <input type="text" name="selling_price" pattern="\d*" class="form-control" placeholder="Selling Price" required>
                        </div>
                         <div class="col-sm-6">
                            <label>Cost Price</label>
                            <input type="text" name="cost_price" pattern="\d*" class="form-control" placeholder="Cost Price">
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Tax<sup class="error">*</sup></label>
                            <select class="form-control" name="tax" required>
                                <option selected disabled>-- Choose Tax --</option>
                                <option value="0">None</option>
                                <?php $taxes = getTaxes() ?>
                                @foreach($taxes as $tax )
                                <option value="{{$tax->rate}}">{{$tax->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>HSN Code</label>
                            <input type="text" name="hsn_code" class="form-control" placeholder="HSN Code">
                        </div>
                    </div>
                    <div class="row form-group">

                        <div class="col-sm-6">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="Product Code">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="addProduct" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in addEmployeeModal" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Salesman</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmEmployee" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="errorEmployee error" style="display: none;">Fill all required fields.</p>
                    @if(auth()->user()->mode)
                    <div class="form-group">
                        <label>Store<sup class="error">*</sup></label>
                        <select name="store_id" class="form-control" required>
                            <option disabled selected>-- Select Store --</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="store_id" value="0">
                    @endif
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>First Name<sup class="error">*</sup></label>
                            <input type="text" name="fname" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Last Name<sup class="error">*</sup></label>
                            <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Email Address<sup class="error">*</sup></label>
                            <input type="email" name="email" class="form-control" placeholder="Store email" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Photo<sup class="error">*</sup></label>
                            <input type="file" name="photo" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label>ID Proof<sup class="error">*</sup></label>
                            <input type="file" name="verification_doc" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Payout & Incentives<sup class="error">*</sup></label>
                            <select name="incentive_id" class="form-control" required>
                                <option disabled selected>-- Select Incentive --</option>
                                <option value="0">None</option>
                                @foreach(auth()->user()->incentives as $incentive)
                                 <option value="{{$incentive->id}}">{{$incentive->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Password<sup class="error">*</sup></label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="addEmployee" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('js')
<script>
    $('#addCustomer').on('click', function(){
        var parsley = $('.frmCustomer').parsley().isValid();
            if (parsley) {
                $('.errorCustomer').hide();
        var selectBox = $(this).data('select');
        var data = $('.frmCustomer').serialize();
        axios.post('/visitors', data)
        .then(function(response){
            var newCustVal = response.data.id;
            var newCustName = response.data.fname + ' '+ response.data.lname + ' ( ' + response.data.phone + ' ) ';
                // Set the value, creating a new option if necessary
                if ($(".selectCustomer").find("option[value='" + newCustVal + "']").length) {
                    $(".selectCustomer").val(newCustVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newCust = new Option(newCustName, newCustVal, true, true);
                    // Append it to the select
                    $(".selectCustomer").append(newCust).trigger('change');
                }
                $('.frmCustomer').trigger('reset');
                $('.addCustomerModal').modal('hide');
            })
    }else{
        $('.errorCustomer').show();
    }
    });


    $('#addProduct').on('click', function(){
        var parsley = $('.frmProduct').parsley().isValid();
            if (parsley) {
                $('.errorProduct').hide();
        var data = $('.frmProduct').serialize();
        axios.post('/products', data)
        .then(function(response){
            console.log(response);
            var newProdVal = response.data.id;
            var newProdName = response.data.name + ' (' + response.data.product_code + ') ';
            // Set the value, creating a new option if necessary
            if (window.selectedBox.find("option[value='" + newProdVal + "']").length) {
                window.selectedBox.val(newProdVal).trigger("change");
            } else {
                // Create the DOM option that is pre-selected by default
                var newProd = new Option(newProdName, newProdVal, true, true);
                // Append it to the select
                var $selectProduct;
                $(".select-product").each( function() {
                    $selectProduct = $(this).val();
                });

                $(".select-product").append(newProd);
                window.selectedBox.append(newProd).trigger("change");
                var set = $(".select-product");
                var length = set.length;
                set.each( function(index, element) {
                    if (index != (length - 1)) {
                        $(this).val($selectProduct);
                    }
                });

            }
            $('.frmProduct').trigger('reset');
            $('.addProductModal').modal('hide');
        })
    }else{
        $('.errorProduct').show();
    }
    });

    $('#addEmployee').on('click', function(){
        var parsley = $('.frmEmployee').parsley().isValid();
            if (parsley) {
                $('.errorEmployee').hide();
        var selectBox = $(this).data('select');
        // var data = $('.frmEmployee').serialize();
        var formData = new FormData($('.frmEmployee')[0]);
        axios.post('/employees', formData)
        .then(function(response){
            var newEmpVal = response.data.id;
            var newEmpName = response.data.fname + ' '+ response.data.lname + ' ( ' + response.data.phone + ' ) ';
                // Set the value, creating a new option if necessary
                if ($(".selectEmployee").find("option[value='" + newEmpVal + "']").length) {
                    $(".selectEmployee").val(newEmpVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newEmp = new Option(newEmpName, newEmpVal, true, true);
                    // Append it to the select
                    $(".selectEmployee").append(newEmp).trigger('change');
                }
                $('.frmEmployee').trigger('reset');
                $('.addEmployeeModal').modal('hide');
            })
    }else{
        $('.errorEmployee').show();
    }
    });
</script>
@endpush