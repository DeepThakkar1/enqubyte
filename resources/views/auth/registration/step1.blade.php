<h2></h2>
<section class="form-section">
    <h4 class="mb-3">Create your account on Enqubyte</h4>
    <div class="form-group">
        <label for="fname" class="col-form-label text-md-right">{{ __('First Name') }}</label>
        <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="Enter your first name" required autofocus>
        @if ($errors->has('fname'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fname') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="lname" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
        <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" placeholder="Enter your last name" required>
        @if ($errors->has('lname'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('lname') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail ID') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
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
</section>