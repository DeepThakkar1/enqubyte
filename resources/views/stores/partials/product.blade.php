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