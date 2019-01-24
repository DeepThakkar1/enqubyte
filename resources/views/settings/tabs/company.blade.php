<div class="tab-pane fade" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
    <form method="post" action="/settings/company/update" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row p-4">
                <div class="col-sm-4 form-group">
                    <label>Company Name<sup class="error">*</sup></label>
                    <input type="text" class="form-control" name="company_name" value="{{ auth()->user()->company_name }}" placeholder="Company name" required>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Company Type<sup class="error">*</sup></label>
                    <select id="company_type" type="text" class="form-control" name="company_type" required>
                        <option selected disabled>-- Choose Company Type --</option>
                        <option value="0" {{ auth()->user()->company_type == 0 ? 'selected' : '' }}>Automobile</option>
                        <option value="1" {{ auth()->user()->company_type == 1 ? 'selected' : '' }}>Electronics</option>
                        <option value="2" {{ auth()->user()->company_type == 2 ? 'selected' : '' }}>Home Decor</option>
                    </select>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Email Address<sup class="error">*</sup></label>
                    <input type="email" class="form-control" name="company_email" value="{{ auth()->user()->company_email }}" placeholder="Email Address" required>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Phone Number</label>
                    <input type="text" pattern="\d*" maxlength="10" minlength="10" class="form-control" name="company_phone" value="{{ auth()->user()->company_phone }}" placeholder="Phone Number">
                </div>
                <div class="col-sm-4 form-group">
                    <div class="uploadButton customuploadButton">
                        <input type="file" id="uploadFile" class="form-control uploadButton-input" name="company_logo">
                        <label for="uploadFile" class="uploadButton-button">Choose file</label>
                        <span class="uploadButton-file-name">Click to upload</span>
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    @if(auth()->user()->company_logo)
                    <label class="w-100 setting-upload-photo"></label>
                    <img src="{{Storage::url(auth()->user()->company_logo)}}" height="50px">
                    @endif
                </div>
                <div class="col-sm-6 form-group">
                    <label>Address</label>
                    <textarea class="form-control p-3" name="company_address" placeholder="Company Address">{{ auth()->user()->company_address }}</textarea>
                </div>
                <div class="col-sm-6 form-group">
                    <label>Footer Line</label>
                    <textarea class="form-control pt-3 pb-4 pl-3 pr-3" name="footer_line" placeholder="Footer line for invoice note" >{{ auth()->user()->footer_line }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
