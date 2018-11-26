<h2></h2>
<section class="form-section">
    <div class="mt-3 mb-4">
        <h4 class="mb-3">Security</h4>
        <div class="form-group">
            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
            <input id="password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter password" required>
            <p class="m-0 text-muted"><small>The password must contain at least 8 characters with one uppercase and one number.</small></p>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" data-parsley-equalto="#password" class="form-control" name="password_confirmation" placeholder="Enter confirm password" required>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</section>