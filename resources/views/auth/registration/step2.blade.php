<h2></h2>
<section class="form-section">
    <div class="mt-3 mb-4">
        <h4 class="mb-3">Company Details</h4>
        <div class="form-group">
            <label for="company_name" class="col-form-label text-md-right">{{ __('Company Name') }}</label>
            <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" placeholder="Enter your company name" required>
            @if ($errors->has('company_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_type" class="col-form-label text-md-right">{{ __('Company Type') }}</label>
            <select id="company_type" type="text" class="form-control{{ $errors->has('company_type') ? ' is-invalid' : '' }}" name="company_type" value="{{ old('company_type') }}" required>
                <option value="0">Automobile</option>
                <option value="1">Electronics</option>
                <option value="2">Home Decor</option>
            </select>
            @if ($errors->has('company_type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_type') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="company_username" class="col-form-label text-md-right">{{ __('Company Username') }}</label>
            <input id="company_username" type="text" class="form-control{{ $errors->has('company_username') ? ' is-invalid' : '' }}" name="company_username" value="{{ old('company_name') }}" placeholder="Enter company username" required>
            @if ($errors->has('company_username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_username') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="estimated_monthly_sales" class="col-form-label text-md-right">{{ __('Estimated Monthly Sales') }}</label>
            <select id="estimated_monthly_sales" type="text" class="form-control{{ $errors->has('estimated_monthly_sales') ? ' is-invalid' : '' }}" name="estimated_monthly_sales" value="{{ old('estimated_monthly_sales') }}" required>
                <option value="0">Less than 50k</option>
                <option value="1">50k to 2 lacs</option>
                <option value="2">2 lacs to 5 lacs</option>
                <option value="3">more than 5 lacs</option>
            </select>
            @if ($errors->has('estimated_monthly_sales'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('estimated_monthly_sales') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="number_of_employees" class="col-form-label text-md-right">{{ __('Number of Employees') }}</label>
            <select id="number_of_employees" type="text" class="form-control{{ $errors->has('number_of_employees') ? ' is-invalid' : '' }}" name="number_of_employees" value="{{ old('number_of_employees') }}" required>
                <option value="0">0 to 50</option>
                <option value="1">50 to 100</option>
                <option value="2">100 to 150</option>
                <option value="3">150 to 200</option>
                <option value="4">more than 200</option>
            </select>
            @if ($errors->has('number_of_employees'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('number_of_employees') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group mt-3">
            <a href="#next" class="btn btn-primary mb-4 btn-lg btn-block wizard-control" data-parsley-group="block-1">
                Next
            </a>
            <div class="loginSignUpSeparator"><span class="textInSeparator">or</span></div>
            <a class="btn btn-block btn-info btn-lg" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </div>
    </div>
</section>