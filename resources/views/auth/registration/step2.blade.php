<h2></h2>
<section class="form-section">
    <h2 class="mb-4 pb-3">Enter your contact details</h2>
    <div class="form-group">
        <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="First name" required autofocus>
        @if ($errors->has('fname'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fname') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" placeholder="Last name" required>
        @if ($errors->has('lname'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('lname') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?: request('email') }}" data-parsley-remote="{{url('/users/email/{value}/available')}}" data-parsley-remote-message="Email already exist!" placeholder="Email address" required>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

     

    <div class="form-group mt-3">
        <a href="#next" class="btn btn-primary mb-4 btn-lg btn-block wizard-control" data-parsley-group="block-1">
            {{ __('Continue') }} <i class="fas fa-arrow-right" style="font-size: 17px;"></i>
        </a>
    </div>
</section>






