<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Product Code</th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->product_code}}</td>
            <td>{{$product->cost_price}}</td>
            <td>{{$product->selling_price}}</td>
            <td>{{$product->stock}}</td>
        </tr>
        @endforeach
    </tbody>
</table>