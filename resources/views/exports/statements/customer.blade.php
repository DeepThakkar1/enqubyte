<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Total Earnings</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $key => $customer)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$customer->fullname}} ({{$customer->phone}})</td>
            <td>&#8377; {{$customer->total_earnings}}</td>
        </tr>
        @endforeach
    </tbody>
</table>