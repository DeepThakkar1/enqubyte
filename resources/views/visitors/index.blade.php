@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Visitors</h2>
        <a href="#addVisitorModal" data-toggle="modal" class="btn btn-primary float-right"><!-- <i class="fa fa-plus-circle"></i> --> Add Visitor</a>
    </div>
    <!-- <hr> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $key => $visitor)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$visitor->fullname}}</td>
                    <td>{{$visitor->email}}</td>
                    <td>{{$visitor->phone}}</td>
                    <td>
                        <a href="#editVisitorModal{{$key}}" data-toggle="modal" class="btn btn-primary btn-sm product-edit-btn"><i class="fas fa-pencil-alt"></i>  </a>
                        <form method="post" action="/visitors/{{$visitor->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger product-delete-btn" onclick="return confirm('Are you sure, You want to delete this employee?');"><i class="fa fa-trash"></i> </button>
                        </form>

                        <div class="modal fade in editVisitorModal{{$key}}" id="editVisitorModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Visitor</h5>
                                        <button type="button" class="close btn-close-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/visitors/{{$visitor->id}}/update">
                                        @csrf
                                        <div class="modal-body">
                                            @if(auth()->user()->mode)
                                            <div class="form-group">
                                                <label>Store<sup class="error">*</sup></label>
                                                <select name="store_id" class="form-control" required>
                                                    <option disabled>-- Select Store --</option>
                                                    @foreach($stores as $store)
                                                    <option value="{{$store->id}}" {{$visitor->store_id == $store->id ? 'selected' : ''}}>{{$store->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="hidden" name="store_id" value="0">
                                            @endif
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <label>First Name<sup class="error">*</sup></label>
                                                    <input type="text" name="fname" value="{{$visitor->fname}}" class="form-control" placeholder="First name" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Last Name<sup class="error">*</sup></label>
                                                    <input type="text" name="lname" value="{{$visitor->lname}}" class="form-control" placeholder="Last name" required>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <label>Email ID<sup class="error">*</sup></label>
                                                    <input type="email" name="email" value="{{$visitor->email}}" class="form-control" placeholder="Visitor email" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Phone<sup class="error">*</sup></label>
                                                    <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" value="{{$visitor->phone}}" class="form-control" placeholder="Phone" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" placeholder="Address">{{$visitor->address}}</textarea>
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
    {{ $visitors->links() }}
</div>



<div class="modal fade in addVisitorModal" id="addVisitorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Visitor</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/visitors">
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
                            <input type="email" name="email" class="form-control" placeholder="Visitor email" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
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
