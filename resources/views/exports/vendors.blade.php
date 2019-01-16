<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Contact Person</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendors as $key => $vendor)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$vendor->name}}</td>
            <td>{{$vendor->email}}</td>
            <td>{{$vendor->phone}}</td>
            <td>{{$vendor->contact_person}}</td>
        </tr>
        @endforeach
    </tbody>
</table>