@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Incentives</h2>
        <a href="#addIncentiveModal" data-toggle="modal" class="btn btn-primary float-right">Add Incentives</a>
    </div>
    <!-- <hr> -->
    <div class="">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Rate</th>
                    <th>Minimum Invoice Amt.</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incentives as $key => $incentive)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$incentive->name}}</td>
                    <td>{{$incentive->type == 1 ? 'Fixed' : 'Percentage'}}</td>
                    <td>{!!$incentive->type == 1 ? '&#8377;' : ''!!} {{$incentive->rate}} {{$incentive->type == 2 ? '%' : ''}}</td>
                    <td>{{$incentive->minimum_invoice_amt ? $incentive->minimum_invoice_amt : '-'}}</td>
                    <td>
                        <a href="#editIncentiveModal{{$key}}" data-toggle="modal" class="btn btn-sm incentive-edit-btn"><i class="fas fa-pencil-alt"></i>  </a>
                        <form method="post" action="/incentives/{{$incentive->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm incentive-delete-btn" onclick="return confirm('Are you sure, You want to delete this incentive?');"><i class="fa fa-trash"></i> </button>
                        </form>

                        <div class="modal fade in editIncentiveModal{{$key}}" id="editIncentiveModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Incentive</h5>
                                        <button type="button" class="close btn-close-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/incentives/{{$incentive->id}}/update">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name<sup class="error">*</sup></label>
                                                <input name="name" class="form-control" placeholder="Name" value="{{$incentive->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Type<sup class="error">*</sup></label>
                                                <select name="type" class="form-control">
                                                    <option value="">-- Choose Type --</option>
                                                    <option value="1" {{$incentive->type == 1 ? 'selected' : ''}}>Fixed</option>
                                                    <option value="2" {{$incentive->type == 2 ? 'selected' : ''}}>Percent</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <input name="rate" class="form-control" placeholder="Rate" value="{{$incentive->rate}}">
                                            </div>
                                            <div class="form-group divMinimumInviceAmt" style="display:{{$incentive->minimum_invoice_amt ? 'block' : 'none'}};">
                                                <label>Minimum Invoice Amount</label>
                                                <input name="minimum_invoice_amt" class="form-control" value="{{$incentive->minimum_invoice_amt ? $incentive->minimum_invoice_amt : ''}}" placeholder="Minimum Invoice Amount">
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



<div class="modal fade in addIncentiveModal" id="addIncentiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Incentive</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/incentives">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name<sup class="error">*</sup></label>
                        <input name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Type<sup class="error">*</sup></label>
                        <select name="type" class="form-control">
                            <option value="">-- Choose Type --</option>
                            <option value="1">Fixed</option>
                            <option value="2">Percent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rate</label>
                        <input name="rate" class="form-control" placeholder="Rate">
                    </div>
                    <div class="form-group divMinimumInviceAmt" style="display:none;">
                        <label>Minimum Invoice Amount</label>
                        <input name="minimum_invoice_amt" class="form-control" placeholder="Minimum Invoice Amount">
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
@push('js')
    <script>
        $('[name="type"]').on('change', function(){
            var type = $(this).val();
            if(type == 1){
                $('.divMinimumInviceAmt').show();
            }else{
                $('.divMinimumInviceAmt').hide();
                $('[name="minimum_invoice_amt"]').val('');
            }
        });
    </script>
@endpush