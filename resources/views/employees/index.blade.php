@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Employees</h2>
        <a href="#addEmployeeModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Employee</a>
    </div>
    <!-- <hr> -->
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Photo</th>
                @if(auth()->user()->mode)
                <th>Store</th>
                @endif
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th width="160px">Action</th>
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
                @if(auth()->user()->mode)
                <td>{{$employee->store->name}}</td>
                @endif
                <td>{{$employee->fullname}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->phone}}</td>
                <td>
                    <a href="#editEmployeeModal{{$key}}" data-toggle="modal" class="btn btn-primary btn-sm product-edit-btn"><i class="fas fa-pencil-alt"></i> Edit </a>
                    <form method="post" action="/employees/{{$employee->id}}/delete" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this employee?');"><i class="fa fa-trash"></i> Delete</button>
                    </form>

                    <div class="modal fade in editEmployeeModal{{$key}}" id="editEmployeeModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Employee</h5>
                                    <button type="button" class="close btn-close-modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/employees/{{$employee->id}}/update" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @if(auth()->user()->mode)
                                        <div class="form-group">
                                            <label>Store<sup class="error">*</sup></label>
                                            <select name="store_id" class="form-control" required>
                                                <option disabled>-- Select Store --</option>
                                                @foreach($stores as $store)
                                                <option value="{{$store->id}}" {{$employee->store_id == $store->id ? 'selected' : ''}}>{{$store->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else
                                        <input type="hidden" name="store_id" value="0">
                                        @endif
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>First Name<sup class="error">*</sup></label>
                                                <input type="text" name="fname" value="{{$employee->fname}}" class="form-control" placeholder="First name" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Last Name<sup class="error">*</sup></label>
                                                <input type="text" name="lname" value="{{$employee->lname}}" class="form-control" placeholder="Last name" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>Email ID<sup class="error">*</sup></label>
                                                <input type="email" name="email" value="{{$employee->email}}" class="form-control" placeholder="Store email" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Phone<sup class="error">*</sup></label>
                                                <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" value="{{$employee->phone}}" class="form-control" placeholder="Phone" required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                                @if($employee->photo)
                                                <img src="{{Storage::url($employee->photo)}}" width="100px" class="mt-2">
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <label>ID Proof</label>
                                                <input type="file" name="verification_doc" class="form-control">
                                                @if($employee->verification_doc)
                                                <img src="{{Storage::url($employee->verification_doc)}}" width="100px" class="mt-2">
                                                @endif
                                            </div>
                                        </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <label>Password<sup class="error">*</sup></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            {{ $employees->links() }}
        </div>


        <div class="modal fade in addEmployeeModal" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="close btn-close-modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="/employees" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @if(auth()->user()->mode)
                            <div class="form-group">
                                <label>Store<sup class="error">*</sup></label>
                                <select name="store_id" class="form-control" required>
                                    <option disabled selected>-- Select Store --</option>
                                    @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="store_id" value="0">
                            @endif
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label>First Name<sup class="error">*</sup></label>
                                    <input type="text" name="fname" class="form-control" placeholder="First name" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name<sup class="error">*</sup></label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label>Email ID<sup class="error">*</sup></label>
                                    <input type="email" name="email" class="form-control" placeholder="Store email" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Phone<sup class="error">*</sup></label>
                                    <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label>Photo<sup class="error">*</sup></label>
                                    <input type="file" name="photo" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>ID Proof<sup class="error">*</sup></label>
                                    <input type="file" name="verification_doc" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label>Password<sup class="error">*</sup></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @endsection
