<div class="card mb-4">
    <div class="card-body">
        <h3 class="d-inline-block ">Products</h3>
        <a href="#addProductModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Product</a>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->stock}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
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