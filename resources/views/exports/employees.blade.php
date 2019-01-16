<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Incentive</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $key => $employee)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$employee->fullname}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{isset($employee->incentive) && $employee->incentive ? $employee->incentive->name : 'None'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>