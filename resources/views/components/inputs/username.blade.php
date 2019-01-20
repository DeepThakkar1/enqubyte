<div class="input-group">
    @if($isRegister)
    <input id="{{ $inputName }}" autocomplete="off" maxlength="22" type="text" class="form-control{{ $errors->has('$inputName') ? ' is-invalid' : '' }} username-input" name="{{$inputName}}" value="{{ old('$inputName') }}" placeholder="{{ $inputPlaceholder }}"
    data-parsley-remote="{{url('/users/username/{value}/available')}}" data-parsley-remote-message="Username already exist!" required style="width: auto !important;">
    @else
     <input id="{{ $inputName }}" autocomplete="off" maxlength="22" type="text" class="form-control{{ $errors->has('$inputName') ? ' is-invalid' : '' }} username-input" name="{{$inputName}}" value="{{ old('$inputName') }}" placeholder="{{ $inputPlaceholder }}"
     required style="width: auto !important;">
    @endif
    <div class="input-group-append">
        <span class="input-group-text">.enqubyte.com</span>
    </div>
</div>
@push('bottom')
    <script src="{{ asset('js/jquery.alphanum.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#{{$inputName}}').alphanum();
            $("#{{$inputName}}").on({
              keydown: function(e) {
                if (e.which === 32)
                  return false;
              },
              change: function() {
                this.value = this.value.replace(/\s/g, "");
              }
            });
        });
    </script>

@endpush