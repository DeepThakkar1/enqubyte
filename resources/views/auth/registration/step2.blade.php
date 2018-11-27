<h2></h2>
<section class="form-section mt-4">
    <div class="mt-3 mb-4">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> <strong> Tell us about company.</strong><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.
        </div>
        <div class="form-group">
             @include('components.inputs.username', ['inputName' => 'company_username', 'inputPlaceholder' => 'Username'])
            <p class="m-0 text-muted"><small>{{ __('This will be the sub-domain to your dashboard.') }}</small></p>
            @if ($errors->has('company_username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_username') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" placeholder="Company name" required>
            @if ($errors->has('company_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <select id="company_type" type="text" class="form-control{{ $errors->has('company_type') ? ' is-invalid' : '' }}" name="company_type" value="{{ old('company_type') }}" required>
                <option selected disabled>-- Choose Company Type --</option>
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
            <select id="estimated_monthly_sales" type="text" class="form-control{{ $errors->has('estimated_monthly_sales') ? ' is-invalid' : '' }}" name="estimated_monthly_sales" value="{{ old('estimated_monthly_sales') }}" required>
                <option selected disabled>-- Estimated Monthly Sales --</option>
                <option value="0">Less than 50k</option>
                <option value="1">50k to 2 lacs</option>
                <option value="2">2 lacs to 5 lacs</option>
                <option value="3">more than 5 lacs</option>
            </select>
            <p class="m-0 text-muted"><small>{{ __('This will be the sub-domain to your dashboard.') }}</small></p>
            @if ($errors->has('estimated_monthly_sales'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('estimated_monthly_sales') }}</strong>
            </span>
            @endif
        </div>

        <!-- <div class="form-group">
            <select id="number_of_employees" type="text" class="form-control{{ $errors->has('number_of_employees') ? ' is-invalid' : '' }}" name="number_of_employees" value="{{ old('number_of_employees') }}" required>
                <option selected disabled>-- Number of Employees --</option>
                <option value="0">0 to 50</option>
                <option value="1">50 to 100</option>
                <option value="2">100 to 150</option>
                <option value="3">150 to 200</option>
                <option value="4">more than 200</option>
            </select>
            <p class="m-0 text-muted"><small>{{ __('This will be the sub-domain to your dashboard.') }}</small></p>

            @if ($errors->has('number_of_employees'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('number_of_employees') }}</strong>
            </span>
            @endif
        </div> -->

        <div class="form-group mt-3">
            <a href="#next" class="btn btn-primary mb-4 btn-lg btn-block wizard-control" data-parsley-group="block-1">
                {{ __('Continue') }}
            </a>
        </div>
    </div>
</section>