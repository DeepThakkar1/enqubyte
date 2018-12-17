@extends('layouts.app')

@section('content')
<div class="">

    <h2 class="d-inline-block ">{{$store->name}}</h2>
    <hr>
    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-1"><i class="fa fa-map-marker-alt mr-1"></i> {{$store->address}}</p>
            <p class="mb-1"><i class="fa fa-map-marked-alt"></i> {{$store->location}}, {{$store->pincode}}</p>
            <p class="mb-1"><i class="fa fa-phone mr-1"></i> {{$store->phone}}</p>
            <p class="mb-3"><i class="fa fa-envelope mr-1"></i> {{$store->email}}</p>
            <a href="#editStoreModal{{$store->id}}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
            <form method="post" action="/stores/{{$store->id}}/delete" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this store?');"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
    @include('stores.partials.manager')
    @include('stores.partials.employee')
    @include('stores.partials.product')

    <div class="modal fade in editStoreModal{{$store->id}}" id="editStoreModal{{$store->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/stores/{{$store->id}}/update">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Store Name<sup class="error">*</sup></label>
                            <input type="text" name="name" value="{{isset($store->name)? $store->name : ''}}" class="form-control" placeholder="Store name" required>
                        </div>
                        <div class="form-group">
                            <label>Address<sup class="error">*</sup></label>
                            <textarea type="text" name="address" class="form-control" placeholder="Address" required>{{isset($store->address)? $store->address : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Location<sup class="error">*</sup></label>
                            <input type="text" name="location" value="{{isset($store->location)? $store->location : ''}}" class="form-control" placeholder="Location" required>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label>Email ID<sup class="error">*</sup></label>
                                <input type="email" name="email" value="{{isset($store->email)? $store->email : ''}}" class="form-control" placeholder="Store email" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Phone<sup class="error">*</sup></label>
                                <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" value="{{isset($store->phone)? $store->phone : ''}}" class="form-control" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pin Code<sup class="error">*</sup></label>
                            <input type="text" name="pincode" value="{{isset($store->pincode)? $store->pincode : ''}}" pattern="\d*" class="form-control" placeholder="Pin Code" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript">


</script>
@endpush