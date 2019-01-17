<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Product</th>
            <th>Qty Sold</th>
            <th>Total Revenue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($statement as $key => $entry)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$entry->product->name}}</td>
            <td>{{$entry->qty_sold}}</td>
            <td>&#8377; {{$entry->revenue}}</td>
        </tr>
        @endforeach
    </tbody>
</table>