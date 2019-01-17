<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Total Payments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendors as $key => $vendor)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$vendor->name}} ({{$vendor->phone}})</td>
            <td>&#8377; {{$vendor->total_payments}}</td>
        </tr>
        @endforeach
    </tbody>
</table>