<div class="input-group">
    @if($isRegister)
    <input id="{{ $inputName }}" autocomplete="off" maxlength="22" type="text" class="user-login-input-custom form-control{{ $errors->has('$inputName') ? ' is-invalid' : '' }} username-input" name="{{$inputName}}" value="{{ old('$inputName') }}" placeholder="{{ $inputPlaceholder }}"
    data-parsley-remote="{{url('/users/username/{value}/available')}}" data-parsley-remote-message="Username already exist!" required >
    @else
     <input id="{{ $inputName }}" autocomplete="off" maxlength="22" type="text" class="user-login-input-custom form-control{{ $errors->has('$inputName') ? ' is-invalid' : '' }} username-input" name="{{$inputName}}" value="{{ old('$inputName') }}" placeholder="{{ $inputPlaceholder }}"
     required >
    @endif
    <div class="input-group-append input-group-append-button">
        <span class="input-group-text">.enqubyte.com</span>
    </div>
</div>
@push('bottom')
    <script src="{{ asset('js/jquery.alphanum.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#{{$inputName}}').alphanum({
              allowSpace: false, // Allow the space character
              forceLower: true  // Convert to lower Case characters
            });
            /*$("#{{$inputName}}").on({
              keydown: function(e) {
                if (e.which === 32)
                  return false;
              },
              change: function() {
                this.value = this.value.replace(/\s/g, "");
              }
            });*/
        });
    </script>

@endpush