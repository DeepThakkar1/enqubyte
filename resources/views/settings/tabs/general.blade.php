<div class="tab-pane fade" id="pills-advance" role="tabpanel" aria-labelledby="pills-general-tab">
    <!-- <form method="post" action="/settings/general/mode">
        @csrf
        <div class="card">
            <div class="card-header">
                Store Mode
            </div>
            <div class="row p-4">
                <div class="col-sm-3 text-center">
                    <label class="mr-4" for="chk-singleStore">
                        <input type="radio" class="radio" name="mode" value="0" {{auth()->user()->mode ? '' : 'checked'}} checked id="chk-singleStore">
                        <h4>Single Store</h4>
                    </label>
                </div>
                <div class="col-sm-3 text-center">
                    <label class="mr-4" for="chk-multiStore">
                        <input type="radio" class="radio" name="mode" value="1" {{auth()->user()->mode ? 'checked' : ''}} id="chk-multiStore">
                        <h4>Multi Store</h4>
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form> -->

    <form method="post" action="/settings/general/taxmode">
        @csrf
        <div class="card mb-3">
            <div class="card-header" style="background-color: #fff;">
                <h6>Tax Mode</h6> 
                <small style="font-size: 13px;display: block;color: #1b6dab;font-weight: 400;"><i class="fas fa-info-circle"></i> Choose the way tax is added to your receipts. It can either be applied to each product seperately or on subtotal.</small>
            </div>
            <div class="card-body py-4">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="perProductRadio" name="taxmode" value="1" {{auth()->user()->taxmode ? 'checked' : ''}} class="custom-control-input">
                    <label class="custom-control-label pt-1 pr-3 pl-1" for="perProductRadio">Tax on Product</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="perInvoiceRadio" name="taxmode" value="0" {{auth()->user()->taxmode ? '' : 'checked'}} class="custom-control-input">
                    <label class="custom-control-label pt-1 pr-3 pl-1" for="perInvoiceRadio">Tax on Sub Total</label>
                </div>
                <div class="row mt-3" style="display: none;">
                    <div class="col-sm-4">
                        <select class="form-control form-control-sm selectMultipleTax" multiple name="invoicetaxes[]"  style="width: 150px;">
                            <option value="" disabled>-- Choose Tax --</option>
                            <?php $invoicetaxes = explode(',', auth()->user()->invoicetaxes); ?>
                            <option value="0" {{in_array(0, $invoicetaxes) ? 'selected' : ''}}>None</option>
                            <?php $taxes = getTaxes() ?>
                            @foreach($taxes as $key => $tax)
                            <option value="{{$tax->id}}" {{in_array($tax->id , $invoicetaxes) ? 'selected' : ''}}>{{$tax->abbreviation}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 mt-1">
                        <a href="/taxes" class="btn btn-link">Edit Default Taxes</a>
                    </div>  
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    <form method="post" action="/settings/general/report">
        @csrf
        <div class="card">
            <div class="card-header" style="background-color: #fff;">
                <h6>Reports Frequency</h6> 
                <small style="font-size: 13px;display: block;color: #1b6dab;font-weight: 400;"><i class="fas fa-info-circle"></i> At what frequency your business reports should be mailed to you.</small>
            </div>
            <div class="card-body py-4">
                <div class="custom-control custom-checkbox d-inline-block">
                  <input type="checkbox" class="custom-control-input"  name="weekly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->weekly ? 'checked' : ''}} value="1" id="chkWeekly">
                  <label class="custom-control-label pt-1 pr-3 pl-1" for="chkWeekly"> Weekly </label>
              </div>
              <div class="custom-control custom-checkbox d-inline-block">
                  <input type="checkbox" class="custom-control-input" name="monthly" id="chkMonthly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->monthly ? 'checked' : ''}} value="1">
                  <label class="custom-control-label pt-1 pr-3 pl-1" for="chkMonthly" > Monthly </label>
              </div>
              <div class="custom-control custom-checkbox d-inline-block">
                  <input type="checkbox" class="custom-control-input"  name="quarterly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->quarterly ? 'checked' : ''}} value="1" id="chkQuarterly">
                  <label class="custom-control-label pt-1 pr-3 pl-1" for="chkQuarterly"> Quarterly </label>
              </div>
              <div class="custom-control custom-checkbox d-inline-block">
                  <input type="checkbox" class="custom-control-input"  name="sixmonth" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->sixmonth ? 'checked' : ''}} value="1" id="chkSixMonth">
                  <label class="custom-control-label pt-1 pr-3 pl-1" for="chkSixMonth"> Six Month </label>
              </div>
              <div class="custom-control custom-checkbox d-inline-block">
                  <input type="checkbox" class="custom-control-input" id="chkYearly"  name="yearly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->yearly ? 'checked' : ''}} value="1" id="chkYearly">
                  <label class="custom-control-label pt-1 pr-3 pl-1" for="chkYearly"> Yearly </label>
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
</div>

@push('js')
<script>
    $('[name="taxmode"]').on('click', function(){
        var taxmode = $(this).val();
        console.log(taxmode);
        if(taxmode == 0){
            $('.selectMultipleTax').parents('.row').show();
        }else{
            $('.selectMultipleTax').parents('.row').hide();
        }
    });
    if($("#perInvoiceRadio").is(':checked'))
        $('.selectMultipleTax').parents('.row').show();
    else
        $('.selectMultipleTax').parents('.row').hide();

</script>
@endpush