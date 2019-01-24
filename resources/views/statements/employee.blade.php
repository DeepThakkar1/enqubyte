@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents headline-contents-height">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Salesman Incentives
        </h2>
        <div class="float-md-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="/profitandlossexcel" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    <a href="/profitandlosspdf" class="btn btn-light"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/profitandlosscsv" class="btn btn-light"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
        </div>
    </div>
   {{--  @include('components.tabs.tabularChart') --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <table class="table dataTable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Total Earning</th>
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
                        <td>&#8377; {{$employee->incentive_amount}} </td>
                        <td>&#8377; {{$employee->incentive_paid_amount}}</td>
                        <td>&#8377; {{$employee->incentive_amount - $employee->incentive_paid_amount}}</td>
                        <td> <span class="badge badge-{{$employee->incentive_amount - $employee->incentive_paid_amount == 0 ? 'success' : 'warning'}}">{{$employee->incentive_amount - $employee->incentive_paid_amount == 0 ? 'Paid' : 'Pending'}}</span> </td>
                        <td>
                            <a href="#incentivePaymentModal{{$key}}" data-toggle="modal" class="btn btn-sm btn-primary {{$employee->incentive_amount - $employee->incentive_paid_amount == 0 ? 'disabled' : ''}}"><i class="fa fa-money"></i> Pay</a>
                            <a href="/employees/{{$employee->id}}" class="btn btn-sm "><i class="fa fa-eye"></i></a>

                            <div class="modal fade in incentivePaymentModal{{$key}} pr-md-0" id="incentivePaymentModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Record a incentive payment for this employee</h5>
                                            <button type="button" class="close btn-close-modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/incentives/{{$employee->id}}/pay">
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Pay</button>
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
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            @include('statements.partials.incentiveschart')
        </div>
    </div>

    @endsection
