@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="d-inline-block ">Stores</h2>
    <a href="#addStoreModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Store</a>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Store Name</h3>
                    <p class="mb-1"><i class="fa fa-envelope"></i> example@email.com</p>
                    <p class="mb-1"><i class="fa fa-map-marker"></i> College Road, Nashik, 422020</p>
                    <p class="mb-1"><i class="fa fa-phone"></i> 9874563210</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Store Name</h3>
                    <p>example@email.com</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Store Name</h3>
                    <p>example@email.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
