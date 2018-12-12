<div class="card mb-4">
    <div class="card-body">
        <h3 class="d-inline-block ">Employees</h3>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Photo</th>
                    <th>Store</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $key => $employee)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        @if($employee->photo)
                        <img src="{{Storage::url($employee->photo)}}" width="100px">
                        @else
                        <img src="{{asset('img/user.png')}}" width="100px">
                        @endif
                    </td>
                    <td>{{$employee->store->name}}</td>
                    <td>{{$employee->fullname}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>
                        <a href="#editEmployeeModal{{$key}}" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i> Edit </a>
                        <form method="post" action="/employees/{{$employee->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this employee?');"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</div>