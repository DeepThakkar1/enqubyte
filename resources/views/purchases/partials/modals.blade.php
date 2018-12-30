<div class="modal fade in addVendorModal" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Vendor</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmVendor">
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
                            <label>Name<sup class="error">*</sup></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Vendor email" >
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
                    <button type="button" id="addVendor" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
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
                            <select class="form-control" name="tax" required>
                                <option selected disabled>-- Choose Tax --</option>
                                <option value="0">None</option>
                                <?php $taxes = getTaxes() ?>
                                @foreach($taxes as $tax )
                                    <option value="{{$tax->rate}}">{{$tax->abbreviation}}</option>
                                @endforeach
                            </select>
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
        $('#addVendor').on('click', function(){
            var data = $('.frmVendor').serialize();
            axios.post('/vendors', data)
            .then(function(response){
                var newVendorVal = response.data.id;
                var newVendorName = response.data.name + ' ( ' + response.data.phone + ' ) ';
                // Set the value, creating a new option if necessary
                if ($(".selectVendor").find("option[value='" + newVendorVal + "']").length) {
                    $(".selectVendor").val(newVendorVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newVendor = new Option(newVendorName, newVendorVal, true, true);
                    // Append it to the select
                    $(".selectVendor").append(newVendor).trigger('change');
                }
                $('.frmVendor').trigger('reset');
                $('.addVendorModal').modal('hide');
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
        });
    </script>
@endpush