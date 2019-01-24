<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $key => $customer)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$customer->fullname}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->phone ? $customer->phone : '--'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>