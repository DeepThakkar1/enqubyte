@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
         <h2 class="d-inline-block headline-content">Stores</h2>
         <a href="#addStoreModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Store</a>
    </div>
    <!-- <hr> -->
    <div class="row">
        @foreach($stores as $store)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>{{str_limit($store->name, 22)}}</h4>
                    <p class="mb-3"><i class="fas fa-map-marker"></i> {{$store->location}}, {{$store->pincode}}</p>
                    <a href="/stores/{{$store->id}}" class="btn btn-sm btn-primary"><i class="fa fa-wrench"></i> Manage</a>
                    <form method="post" action="/stores/{{$store->id}}/delete" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this store?');"><i class="fa fa-trash"></i> </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade in addStoreModal" id="addStoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Store</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/stores">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Store Name<sup class="error">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Store name" required>
                    </div>
                    <div class="form-group">
                        <label>Address<sup class="error">*</sup></label>
                        <textarea type="text" name="address" class="form-control" placeholder="Address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Location<sup class="error">*</sup></label>
                        <input type="text" name="location" class="form-control" placeholder="Location" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Store email" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pin Code<sup class="error">*</sup></label>
                        <input type="text" name="pincode" pattern="\d*" class="form-control" placeholder="Pin Code" required>
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