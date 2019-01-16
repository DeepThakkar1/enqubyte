<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Total Earning</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $key => $employee)
        <tr>
            <td>{{$key +1}}</td>
            <td>{{$employee->fullname}}</td>
            <td>&#8377; {{$employee->incentive_amount}} </td>
            <td>&#8377; {{$employee->incentive_paid_amount}}</td>
            <td>&#8377; {{$employee->incentive_amount - $employee->incentive_paid_amount}}</td>
            <td> <span class="badge badge-{{$employee->incentive_amount - $employee->incentive_paid_amount == 0 ? 'success' : 'warning'}}">{{$employee->incentive_amount - $employee->incentive_paid_amount == 0 ? 'Paid' : 'Pending'}}</span> </td>
        </tr>
        @endforeach
    </tbody>
</table>