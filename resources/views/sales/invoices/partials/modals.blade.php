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
                            <label>Email ID</label>
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
                            <label>Available Stock</label>
                            <input type="text" pattern="\d*" name="stock" class="form-control" placeholder="Available Stock">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Cost Price</label>
                            <input type="text" name="cost_price" pattern="\d*" class="form-control" placeholder="Cost Price">
                        </div>
                        <div class="col-sm-6">
                            <label>Tax<sup class="error">*</sup></label>
                            <input type="text" pattern="\d*" name="tax" class="form-control" placeholder="Tax" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>HSN Code</label>
                            <input type="text" name="hsn_code" class="form-control" placeholder="HSN Code">
                        </div>
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


@push('js')
    <script>
        $('#addCustomer').on('click', function(){
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
        });


        $('#addProduct').on('click', function(){
            var data = $('.frmProduct').serialize();
            axios.post('/products', data)
            .then(function(response){
                console.log(response);
                var newProdVal = response.data.id;
                var newProdName = response.data.name + ' (' + response.data.product_code + ') ';
                // Set the value, creating a new option if necessary
                if ($(".select-product").find("option[value='" + newProdVal + "']").length) {
                    $(".select-product").val(newProdVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newProd = new Option(newProdName, newProdVal, true, true);
                    // Append it to the select
                    $(".select-product").append(newProd).trigger('change');
                }
                $('.frmProduct').trigger('reset');
                $('.addProductModal').modal('hide');
            })
        });
    </script>
@endpush