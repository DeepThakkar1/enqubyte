<div class="modal fade in recordPaymentModal pr-md-0" id="recordPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record a payment for this invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmRecordPayment">
                @csrf
                <div class="modal-body">
                    <p class="errorRecordPayment error" style="display: none;">Fill all required fields.</p>
                    <p>Record a payment you’ve already received, such as cash, cheque, or bank payment.</p>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Payment Date<sup class="error">*</sup></label>
                            <input type="text" name="payment_date" class="form-control datepicker" autocomplete="off" value="{{date('d-m-Y')}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Amount<sup class="error">*</sup></label>
                            <input type="text" name="amount" value="{{isset($invoice->remaining_amount) ? $invoice->remaining_amount : ''}}" class="form-control inputInvoiceAmt" autocomplete="off" placeholder="Amount" required>
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
                        <!-- <div class="col-sm-6">
                            <label>Payment account<sup class="error">*</sup></label>
                            <select class="form-control" name="payment_account" required>
                                <option value="" selected disabled>Select Account</option>
                                <option value="1">Cash on Hand</option>
                                <option value="2">Owner Investment / Drawings</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label>Memo / notes</label>
                        <textarea name="note" class="form-control" placeholder="Memo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="recordPayment" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $('#recordPayment').on('click', function(){
        var parsley = $('.frmRecordPayment').parsley().isValid();
        var payment = $('.inputInvoiceAmt').val();
        if(parsley){
            if (payment != 0 && payment != '') {
                $('.errorRecordPayment').hide();
                $(this).addClass('disabled');
                var data = $('.frmRecordPayment').serialize();
                axios.post('/sales/invoices/{{isset($invoice) ? $invoice->id : ''}}/recordpayment', data)
                .then(function(response){
                    $('.rowAmountDue').hide();
                // $('.invoiceAmt').html(response.data.)
                var paymentType;
                if (response.data.payment.payment_method ==1) {
                    paymentType= 'Bank Payment';
                }else if(response.data.payment.payment_method ==2){
                    paymentType= 'Cash';
                }else if(response.data.payment.payment_method ==3){
                    paymentType= 'Cheque';
                }else if(response.data.payment.payment_method ==4){
                    paymentType= 'Credit Card';
                }else{
                    paymentType= 'Other';
                }
                var html = '<tr><td class="left">\
                Payment on ' + response.data.payment.payment_date + ' using ' + paymentType + ' :</td>\
                <td class="right">\
                <strong>&#8377; ' + response.data.payment.amount + '</strong>\
                </td></tr><tr class="border-top"><td class="left">\
                <strong>Amount Due (INR):</strong></td>\
                <td class="right">\
                <strong>&#8377; ' + response.data.invoice.remaining_amount + '</strong>\
                </td></tr>';
                $('.table-invoiceTotal tbody').append(html);
                $('.frmRecordPayment').trigger('reset');
                $('.invoiceAmt').html(response.data.invoice.remaining_amount);
                $('.inputInvoiceAmt').val(response.data.invoice.remaining_amount);

                $('.invoiceStatus').html(response.data.invoice.remaining_amount ? 'Pending' : 'Completed');
                $('.btnEditInvoice').addClass(response.data.invoice.remaining_amount ? '' : 'disabled');
                $('.btnRecordPayment').addClass(response.data.invoice.remaining_amount ? '' : 'disabled');
                $('.bg-warning.text-white.px-2.rounded').removeClass('bg-warning').addClass(response.data.invoice.remaining_amount ? 'bg-warning' : 'bg-success');

                $('.recordPaymentModal').modal('hide');
            })
            }else{
                $('.errorRecordPayment').html('Please enter valid payable amount.');
                $('.errorRecordPayment').show();
            } }else{
                $('.errorRecordPayment').html('Fill all required fields.');
                $('.errorRecordPayment').show();
            }
        });
    </script>
    @endpush