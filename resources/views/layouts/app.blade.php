<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enqubyte - Your business assistant</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CRoboto:400,500,700,900%7CPlayfair+Display:400,700,700i,900,900i%7CWork+Sans:400,500,600,700" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datetimepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

</head>
<body>
    <div id="app" class="wrapper">
        @auth
            @include('components.sidebar._main')
        @else
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('img/logo.png') }}" height="30px">
                </a>
                <button class="navbar-toggler" style="border:none !important;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/" style="font-size: 14px;">{{ __('HOME') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/features" style="font-size: 14px;">{{ __('FEATURES') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary login-btn-section px-4 ml-md-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link btn btn-primary text-white px-4 ml-md-2" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endauth

        <main id="content">
            @auth
               @include('components.navbar')
            @endauth


            <div class="pt-0 dashboard-all-content-section">
                @include('flash::message')
                @yield('content')
            </div>
        </main>
    </div>
    @stack('css')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/datetimepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



    <script>
        $('form').parsley({
            classHandler: function(el) {
                return el.$element.closest(".form-group");
            }
        });
    </script>
    @stack('js')
    <script>
        $('div.alert-flash.alert-dismissable').not('.alert-important').delay(3000).fadeOut(350);
        $('#flash-overlay-modal').modal();
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            var table = $('.dataTable').DataTable( {
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                // responsive: true,
                searching: false,
                paging: false
            });

            $('.descDataTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                // responsive: true,
                "order": [[ 0, "desc" ]],
                searching: false,
                paging: false
            });

            $('.btn-close-modal').on('click', function(){
                var modal = $(this).parents('.modal');
                var form = $(this).parents('.modal').find('form');
                form.trigger('reset');
                modal.modal('hide');
            });

            jQuery.datetimepicker.setLocale('en');
            jQuery('.datetimepicker').datetimepicker();
            jQuery('.timepicker').datetimepicker({datepicker:false, format:'h:i A'});
            jQuery('.datepicker').datetimepicker({timepicker:false, format:'d-m-Y'});
            jQuery('.birthdatepicker').datetimepicker({timepicker:false, format:'d-m-Y', maxDate:moment('DD/MM/YYYY')});

        });
    </script>

     <script type="text/javascript">
         function closeSelect2(selectName){
                $('.' + selectName).select2('close');
            };

             function closeMultipleSelect2(element, selectName){
                $('.' + selectName).select2('close');
            };


        $(document).ready(function () {
            $("#sidebars").mCustomScrollbar({
                theme: "minimal"
            });

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('.selectWithSearch').select2();
            $('.selectMultipleTax').select2({
                placeholder: 'Select Tax'
            });

            $('#sidebars #dismiss, .overlay').on('click', function () {
                console.log('jshjkhk');
                $('#sidebars').removeClass('active');
                $('#sidebars .overlay').removeClass('active');
            });

            $('#sidebarsCollapse').on('click', function () {
                $('#sidebars').addClass('active');
                $('#sidebars .overlay').addClass('active');
                $('#sidebars .collapse.in').toggleClass('in');
                $('#sidebars a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    @stack('bottom')

    @yield('scripts')

</body>
</html>
