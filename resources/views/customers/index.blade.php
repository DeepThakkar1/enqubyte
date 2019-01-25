@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents border-bottom-0 headline-contents-height">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Customers</h2>
        <div class="float-md-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="/customersexcel" class="btn btn-light {{count($customers) ? '' : 'disabled'}}"><i class="fa fa-file-excel"></i> Excel</a>
                    <a href="/customerspdf" class="btn btn-light {{count($customers) ? '' : 'disabled'}}"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/customerscsv" class="btn btn-light {{count($customers) ? '' : 'disabled'}}"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
            <a href="#addCustomerModal" data-toggle="modal" class="btn btn-primary">Add Customer</a>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td><img src="{{ Avatar::create($customer->fullname)->toBase64() }}" style="width: 32px; height: 32px; margin-right: 7px;">
                        {{$customer->fullname}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>
                        <a href="#editCustomerModal{{$key}}" data-toggle="modal" class="btn btn-sm"><i class="fas fa-pencil-alt"></i>  </a>
                        <a href="/customers/{{$customer->id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                        <form method="post" action="/customers/{{$customer->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger product-delete-btn" onclick="return confirm('Are you sure, You want to delete this customer?');"><i class="fa fa-trash"></i> </button>
                        </form>

                        <div class="modal fade in editCustomerModal{{$key}}" id="editCustomerModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Customer</h5>
                                        <button type="button" class="close btn-close-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/customers/{{$customer->id}}/update">
                                        @csrf
                                        <div class="modal-body">
                                            @if(auth()->user()->mode)
                                            <div class="form-group">
                                                <label>Store<sup class="error">*</sup></label>
                                                <select name="store_id" class="form-control" required>
                                                    <option disabled>-- Select Store --</option>
                                                    @foreach($stores as $store)
                                                    <option value="{{$store->id}}" {{$customer->store_id == $store->id ? 'selected' : ''}}>{{$store->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="hidden" name="store_id" value="0">
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>First Name<sup class="error">*</sup></label>
                                                    <input type="text" name="fname" maxlength="25" value="{{$customer->fname}}" class="form-control" placeholder="First name" required>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>Last Name<sup class="error">*</sup></label>
                                                    <input type="text" name="lname" maxlength="25" value="{{$customer->lname}}" class="form-control" placeholder="Last name" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>Phone<sup class="error">*</sup></label>
                                                    <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" value="{{$customer->phone}}" class="form-control" placeholder="Phone" required>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" value="{{$customer->email}}" class="form-control" placeholder="Customer email" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" placeholder="Address">{{$customer->address}}</textarea>
                                            </div>
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
</div>



<div class="modal fade in addCustomerModal" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/customers">
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
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>First Name<sup class="error">*</sup></label>
                            <input type="text" name="fname" maxlength="25" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Last Name<sup class="error">*</sup></label>
                            <input type="text" name="lname" maxlength="25" class="form-control" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Customer email" data-parsley-remote="{{url('/visitors/email/{value}/available')}}" data-parsley-remote-message="Email already exist!">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
