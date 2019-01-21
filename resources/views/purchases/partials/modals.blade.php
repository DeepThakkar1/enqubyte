<div class="modal fade in addVendorModal pr-md-0" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Vendor</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="frmVendor">
                @csrf
                <div class="modal-body">
                    <p class="errorVendor error" style="display: none;">Fill all required fields.</p>
                    @if(auth()->user()->mode)
                    <div class="form-group">
                        <label>Store<sup class="error">*</sup></label>
                        <select name="store_id" class="form-control" required>
                            <option disabled selected>-- Select Store --</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="store_id" value="0">
                    @endif
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Name<sup class="error">*</sup></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Vendor email" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="button" id="addVendor" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $('#addVendor').on('click', function(){
        var parsley = $('.frmVendor').parsley().isValid();

        if (parsley) {
            $('.errorVendor').hide();
            var data = $('.frmVendor').serialize();
            axios.post('/vendors', data)
            .then(function(response){
                var newVendorVal = response.data.id;
                var newVendorName = response.data.name + ' ( ' + response.data.phone + ' ) ';
                // Set the value, creating a new option if necessary
                if ($(".selectVendor").find("option[value='" + newVendorVal + "']").length) {
                    $(".selectVendor").val(newVendorVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newVendor = new Option(newVendorName, newVendorVal, true, true);
                    // Append it to the select
                    $(".selectVendor").append(newVendor).trigger('change');
                }
                $('.frmVendor').trigger('reset');
                $('.addVendorModal').modal('hide');
            })
        }else{
            $('.errorVendor').show();
        }
    });

</script>
@endpush