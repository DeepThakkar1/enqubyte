<div class="card mb-4">
    <div class="card-body">
        <h3 class="d-inline-block ">Products</h3>
        <!-- <a href="#addProductModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Product</a> -->
        <a href="#assignProductModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Assign Product</a>
        <hr>
        <table class="table table-bordered table-products">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
                <th>Stock</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $key => $stock)
            <tr class="product-row{{$stock->id}}">
                <td>{{$key + 1}}</td>
                <td>{{$stock->product->name}}</td>
                <td>&#8377; {{$stock->product->cost_price}}</td>
                <td>&#8377; {{$stock->product->selling_price}}</td>
                <td><span class="stock-qty">{{ $stock->qty }}</span></td>
                <!-- <td>
                    <a href="#editProductModal{{$key}}" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i> Edit </a>
                    <form method="post" action="/products/{{$stock->id}}/delete" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this product?');"><i class="fa fa-trash"></i> Delete</button>
                    </form>

                    <div class="modal fade in editProductModal{{$key}}" id="editProductModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/products/{{$stock->id}}/update">
                                    @csrf
                                    <div class="modal-body">
                                        <input name="store_id" type="hidden" value="{{$store->id}}">
                                        <div class="form-group">
                                            <label>Product Name<sup class="error">*</sup></label>
                                            <input type="text" name="name" value="{{$stock->product->name}}" class="form-control" placeholder="Product name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description<sup class="error">*</sup></label>
                                            <textarea type="text" name="description" class="form-control" placeholder="Description" required>{{$stock->product->description}}</textarea>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>Selling Price<sup class="error">*</sup></label>
                                                <input type="text" name="selling_price" value="{{$stock->product->selling_price}}" pattern="\d*" class="form-control" placeholder="Selling Price" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Stock</label>
                                                <input type="text" pattern="\d*" name="stock" value="{{$stock->qty}}" class="form-control" placeholder="Stock">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>Cost Price</label>
                                                <input type="text" name="cost_price" value="{{$stock->product->cost_price}}" pattern="\d*" class="form-control" placeholder="Cost Price">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Tax<sup class="error">*</sup></label>
                                                <input type="text" pattern="\d*" name="tax" value="{{$stock->product->tax}}" class="form-control" placeholder="Tax" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>HSN Code</label>
                                                <input type="text" name="hsn_code" value="{{$stock->product->hsn_code}}" class="form-control" placeholder="HSN Code">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Product Code</label>
                                                <input type="text" name="product_code" value="{{$stock->product->product_code}}" class="form-control" placeholder="Product Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<div class="modal fade in addProductModal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/products">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="store_id" value="{{$store->id}}">
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
                            <label>Stock</label>
                            <input type="text" pattern="\d*" name="stock" class="form-control" placeholder="Stock">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in assignProductModal" id="assignProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/products">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        @foreach($allProducts as $product)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="flex: 1">
                                    <h5>{{$product->name}}</h5>
                                    <p class="text-muted mb-1">Product Code : {{$product->product_code}}</p>
                                    <p class="text-muted mb-1">Stock : <span class="productStock">{{$product->stock}}</span></p>
                                </div>
                                <div class="ml-3">
                                    <div class="input-group mb-3">
                                        <input type="number" name="qty" class="form-control" aria-describedby="basic-addon2" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btn-assign-qty" company-id="{{auth()->id()}}" product-id="{{$product->id}}" store-id="{{$store->id}}" type="button">Assign</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')

    <script type="text/javascript">
        $('.btn-assign-qty').on('click', function(){
            var companyId = $(this).attr('company-id');
            var storeId = $(this).attr('store-id');
            var productId = $(this).attr('product-id');
            var qty = $(this).parents('li').find('[name="qty"]').val();
            var productStock = $(this).parents('li').find('.productStock');
            var productRowID = $('.table-products tbody').find('.product-row'+ productId);

            if(qty){
                axios.post('/stores/'+ storeId +'/products/'+ productId +'/assign', {
                    qty:qty,
                })
                .then(function (response) {
                    productStock.html(response.data.product.stock);
                    $('.table-products tbody').find('tr').find('row-id',1);
                    if(productRowID.length ==1){
                        productRowID.find('.stock-qty').html(response.data.stock.qty);
                    }else{
                        tableRows = $('.table-products tbody tr');

                        var newProduct = '<tr class="product-row'+ response.data.product.id +'">\
                        <td>'+ (tableRows.length + 1) +'</td>\
                        <td>'+ response.data.product.name +'</td>\
                        <td>&#8377; ' + response.data.product.cost_price + ' </td>\
                        <td>&#8377; ' + response.data.product.selling_price + '</td>\
                        <td><span class="stock-qty">' + response.data.stock.qty + '</span></td></tr>';

                        $('.table-products tbody').append(newProduct);
                    }
                    //location.reload(true);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }else{
                console.log('else');
            }
        });
    </script>

@endpush