@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents responsive-headline-contents border-bottom-0">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Products</h2>
        <div class="float-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="/productsexcel" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    <a href="/productspdf" class="btn btn-light"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/productscsv" class="btn btn-light"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
            <a href="#addProductModal" data-toggle="modal" class="btn btn-primary">Add Product</a>
        </div>
    </div>
    <div class=" product-add-list">
        <table class="table dataTable">
            <thead>
                <tr class="product-list-menu">
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Product Code</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->product_code}}</td>
                    <td>&#8377; {{$product->cost_price}}</td>
                    <td>&#8377; {{$product->selling_price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>
                        <a href="#editProductModal{{$key}}" data-toggle="modal" class="btn btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/products/{{$product->id}}" class="btn btn-sm"><i class="fa fa-eye"></i>  </a>
                        <form method="post" action="/products/{{$product->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger product-delete-btn" onclick="return confirm('Are you sure, You want to delete this product?');"><i class="fa fa-trash"></i></button>
                        </form>

                        <div class="modal fade in editProductModal{{$key}}" id="editProductModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Product</h5>
                                        <button type="button" class="close btn-close-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/products/{{$product->id}}/update">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- <div class="form-group">
                                                <label>Store<sup class="error">*</sup></label>
                                                <select name="store_id" class="form-control" required>
                                                    <option disabled value="">-- Select Store --</option>
                                                    @foreach($stores as $store)
                                                    <option value="{{$store->id}}" {{$product->id == $store->id ? 'selected' : ''}}>{{$store->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> -->
                                            <div class="form-group">
                                                <label>Product Name<sup class="error">*</sup></label>
                                                <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description<sup class="error">*</sup></label>
                                                <textarea type="text" name="description" class="form-control" placeholder="Description" required>{{$product->description}}</textarea>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <label>Selling Price<sup class="error">*</sup></label>
                                                    <input type="text" name="selling_price" value="{{$product->selling_price}}" pattern="\d*" class="form-control" placeholder="Selling Price" required>
                                                </div>
                                                <!-- <div class="col-sm-6">
                                                    <label>Available Stock</label>
                                                    <input type="text" pattern="\d*" name="stock" value="{{$product->stock}}" class="form-control" placeholder="Available Stock">
                                                </div> -->
                                                <div class="col-sm-6">
                                                    <label>Cost Price</label>
                                                    <input type="text" name="cost_price" value="{{$product->cost_price}}" pattern="\d*" class="form-control" placeholder="Cost Price">
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if(!auth()->user()->taxmode)
                                                <div class="col-sm-6 form-group">
                                                    <label>Tax<sup class="error">*</sup></label>
                                                    <select class="form-control" name="tax" required>
                                                        <option selected disabled>-- Choose Tax --</option>
                                                        <option value="0" {{isset($product->tax) && $product->tax == 0 ? 'selected' : ''}}>None</option>
                                                        <?php $taxes = getTaxes() ?>
                                                        @foreach($taxes as $tax )
                                                        <option value="{{$tax->rate}}" {{isset($product->tax) && $product->tax == $tax->rate ? 'selected' : ''}}>{{$tax->abbreviation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                                <div class="col-sm-6 form-group">
                                                    <label>HSN Code</label>
                                                    <input type="text" name="hsn_code" value="{{$product->hsn_code}}" class="form-control" placeholder="HSN Code">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>Product Code</label>
                                                    <input type="text" name="product_code" value="{{$product->product_code}}" class="form-control" placeholder="Product Code">
                                                </div>
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

<div class="modal fade in addProductModal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/products">
                @csrf
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label>Store<sup class="error">*</sup></label>
                        <select name="store_id" class="form-control" required>
                            <option disabled selected>-- Select Store --</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label>Product Name<sup class="error">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Product name" required>
                    </div>
                    <div class="form-group">
                        <label>Description<sup class="error">*</sup></label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Selling Price<sup class="error">*</sup></label>
                            <input type="text" name="selling_price" pattern="\d*" class="form-control" placeholder="Selling Price" required>
                        </div>
                        <!-- <div class="col-sm-6">
                            <label>Available Stock</label>
                            <input type="text" pattern="\d*" name="stock" class="form-control" placeholder="Available Stock">
                        </div> -->
                        <div class="col-sm-6">
                            <label>Cost Price</label>
                            <input type="text" name="cost_price" pattern="\d*" class="form-control" placeholder="Cost Price">
                        </div>
                    </div>
                    <div class="row">
                        @if(!auth()->user()->taxmode)
                        <div class="col-sm-6 form-group">
                            <label>Tax<sup class="error">*</sup></label>
                            <select class="form-control" name="tax" required>
                                <option selected disabled>-- Choose Tax --</option>
                                <option value="0">None</option>
                                <?php $taxes = getTaxes() ?>
                                @foreach($taxes as $tax )
                                <option value="{{$tax->rate}}" >{{$tax->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-sm-6 form-group">
                            <label>HSN Code</label>
                            <input type="text" name="hsn_code" class="form-control" placeholder="HSN Code">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="Product Code">
                        </div>
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