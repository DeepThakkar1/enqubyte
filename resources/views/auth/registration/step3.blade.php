<h2></h2>
<section class="form-section">
    <div class="mt-3 mb-4">
        <h2 class="mb-4 pb-3">Create your account password</h2>
        {{--  <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> <strong> Let's secure your account.</strong><br>
            {{ __('The password must contain at least 8 characters with one uppercase and one number.') }}
        </div> --}}
        <div class="form-group">
            <input id="password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
            <p class="m-0 text-muted"><small>{{ __('The password must contain at least 8 characters with one uppercase and one number.') }}</small></p>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" data-parsley-equalto="#password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
        </div>

        @if(request()->has('plan') && request('plan') != 'Free')
            <div class="plan">
                <div class="monthly">
                    <h6>{{ $plan->name }} Plan</h6>
                    <h2>&#8377; {{ $plan->price }} / month</h2>
                    <a target="_blank" href="/#pricing">View Pricing Plans</a>
                </div>
            </div>
        @endif

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{ __('Create Account') }}
            </button>
            <div class="loginSignUpSeparator"><span class="textInSeparator">or</span></div>
            <p class="text-center" style="font-size: 17px;">
                <a class="btn-link wizard-control" href="#previous">
                    {{ __('Back') }}
                </a>
            </p>
        </div>
    </div>
</section>