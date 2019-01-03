@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Statements <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Salesman Incentives</h2>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Total Earn</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $key => $employee)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$employee->fullname}}</td>
                    <td>{{$employee->incentive_amount}} </td>
                    <td>500</td>
                    <td>500</td>
                    <td> <span class="badge badge-warning">Pending</span> </td>
                    <td>
                        <a href="" class=""><i class="fa fa-eye"></i> </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade in recordPaymentModal" id="recordPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record a payment for this invoice</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmRecordPayment">
                @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Date<sup class="error">*</sup></label>
                            <input type="text" name="transaction_date" class="form-control datepicker" autocomplete="off" value="{{date('d-m-Y')}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Amount<sup class="error">*</sup></label>
                            <input type="text" name="amount" value="{{isset($invoice->remaining_amount) ? $invoice->remaining_amount : ''}}" class="form-control" autocomplete="off" placeholder="Amount" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <label>Payment Method<sup class="error">*</sup></label>
                            <select class="form-control" name="payment_method" required>
                                <option value="" selected disabled>Select Method</option>
                                <option value="1">Bank Payment</option>
                                <option value="2">Cash</option>
                                <option value="3">Cheque</option>
                                <option value="4">Credit Card</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Memo / notes</label>
                        <textarea name="note" class="form-control" placeholder="Memo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="recordPayment" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
