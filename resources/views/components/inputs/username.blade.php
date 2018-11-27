<input id="{{ $inputName }}" autocomplete="off" type="text" class="form-control{{ $errors->has('$inputName') ? ' is-invalid' : '' }} username-input" name="{{$inputName}}" value="{{ old('$inputName') }}" placeholder="{{ $inputPlaceholder }}" required>

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