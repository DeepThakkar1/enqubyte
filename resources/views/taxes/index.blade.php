@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Taxes</h2>
        <a href="#addTaxModal" data-toggle="modal" class="btn btn-primary custom-back-btn float-right">Add Tax</a>
        </div>
    <div class="">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Tax Name</th>
                    <th>Abbreviation</th>
                    <th>Rate</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxes as $key => $tax)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$tax->name}}</td>
                    <td>{{$tax->abbreviation}}</td>
                    <td>{{$tax->rate}}</td>
                    <td>
                        <a href="#editTaxModal{{$key}}" data-toggle="modal" class="btn btn-sm"><i class="fas fa-pencil-alt"></i>  </a>
                        <form method="post" action="/taxes/{{$tax->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger product-delete-btn" onclick="return confirm('Are you sure, You want to delete this tax?');"><i class="fa fa-trash"></i> </button>
                        </form>

                        <div class="modal fade in editTaxModal{{$key}}" id="editTaxModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Tax</h5>
                                        <button type="button" class="close btn-close-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/taxes/{{$tax->id}}/update">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Tax Name<sup class="error">*</sup></label>
                                                <input type="text" name="name" value="{{$tax->name}}" class="form-control" placeholder="Tax name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Abbreviation<sup class="error">*</sup></label>
                                                <input type="text" name="abbreviation" value="{{$tax->abbreviation}}" class="form-control" placeholder="Abbreviation" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tax Rate<sup class="error">*</sup></label>
                                                <input type="text" pattern="\d*" name="rate" value="{{$tax->rate}}" class="form-control" placeholder="Tax Rate" required>
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
    {{ $taxes->links() }}
</div>



<div class="modal fade in addTaxModal" id="addTaxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Tax</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/taxes">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tax Name<sup class="error">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Tax name" required>
                    </div>
                    <div class="form-group">
                        <label>Abbreviation<sup class="error">*</sup></label>
                        <input type="text" name="abbreviation" class="form-control" data-parsley-remote="{{url('/taxes/abbreviation/{value}/available')}}" data-parsley-remote-message="Abbreviation already exist!" placeholder="Abbreviation" required>
                    </div>
                    <div class="form-group">
                        <label>Tax Rate<sup class="error">*</sup></label>
                        <input type="text" pattern="\d*" name="rate" class="form-control" placeholder="Tax Rate" required>
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
