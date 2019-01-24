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
        @foreach($visitors as $key => $visitor)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$visitor->fullname}}</td>
            <td>{{$visitor->email ? $visitor->email : '--'}}</td>
            <td>{{$visitor->phone ? $visitor->phone : '--'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>