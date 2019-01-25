<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        @include('flash::message')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 mx-3">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-warning alert-dismissable">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="card my-5">
                        <div class="card-body ">
                            <div class="mb-3 mt-1 text-center">
                                <a href="/admin"><img src="{{asset('img\logo.png')}}" height="50px" style="margin-left: -5px;"></a>
                                <h3 class="d-none d-sm-block m-sm-bottom mt-3">{{ __('Admin Login') }}</h3>
                            </div>
                            <form method="POST" action="/admin/login" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group mt-4">
                                    <label class="mb-0"><small>Username<sup class="error">*</sup></small></label>
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus autocomplete="off" placeholder="Enter Username">
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="mb-0"><small>Password<sup class="error">*</sup></small></label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg" >
                                        {{ __('Login') }}
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('div.alert.alert-dismissable').not('.alert-important').delay(3000).fadeOut(350);
    });
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</html>
