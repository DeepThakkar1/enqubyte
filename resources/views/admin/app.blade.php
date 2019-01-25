<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enqubyte - Admin Panel</title>
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

    <!-- Our Custom CSS -->
    <link href="{{ asset('css/sidebar.css') }} " rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" style="background-color: #343536;">
            <div class="sidebar-header" style="background-color: #343536;">
                <a href="/admin/dashboard">
                    <img src="{{ url('img/enque bite colours white.png') }}">
                </a>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->is('admin/dashboard') ? 'active' : ''}}">
                    <a href="/admin/dashboard">
                        <img src="{{ url('img/sidebar/icon/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/icon/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/users') ? 'active' : ''}}">
                    <a href="/admin/users">
                        <img src="{{ url('img/sidebar/icon/visitor.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/icon/vistors.png') }}" class="active-icon">
                        <span>{{ __('Users') }}</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main id="content">
            <nav class="navbar navbar-expand-lg navbar-light  custom-dashboard-navbar">
               <button type="button" id="sidebarCollapse" class="btn btn-info custom-btn-info" style="outline:transparent;display: none;">
                <i class="fas fa-align-left"></i>
            </button>
            <button type="button" id="sidebarsCollapse" class="btn btn-info custom-btn-info-res" style="outline:transparent;">
                <i class="fas fa-align-left"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto dashboard-nav-list">
                    <li class="nav-item active dropdown">
                        <a href="#" class="nav-link text-center dropdown-toggl navbar-cust-icons custom-dashboard-nav-link" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false" style="">
                            <i class="fa fa-bell-o custom-font-icons" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu notify-drop">
                            <div class="notify-drop-title">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">Notifications</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <p style="font-size: 10px;margin-bottom: 0px;padding-top: 3px;"><span class="mr-2">Mark all as read</span> <span>Setting</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="drop-content dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="text-center notification-dropdown-icon">
                                                <a href="">
                                                    <img src="{{ url('img/sidebar/icon/calendar-clr.png') }}" alt="">
                                                    <!-- <i class="fa fa-calendar-check-o" aria-hidden="true" style="display: inline-block;"></i> -->
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8 notification-reminder pl-0">
                                            <h6>REMINDER</h6>
                                            <p>(Sample) Send the pricing quote</p>
                                            <a data-toggle="modal" href="#addMaterialModal" class="nav-link text-center custom-dashboard-nav-link navbar-cust-icons notification-user-initial" style="background-color: rgb(22, 110, 173) !important;"> <b>J</b> </a>
                                            <!-- <p>j</p> -->
                                        </div>
                                        <div class="col-md-2">
                                            <div class="notification-days">
                                                <span>2 Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="text-center notification-dropdown-icon">
                                                <a href="">
                                                    <img src="{{ url('img/sidebar/icon/calendar-clr.png') }}" alt="">
                                                    <!-- <i class="fa fa-calendar-check-o" aria-hidden="true" style="display: inline-block;"></i> -->
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8 notification-reminder pl-0">
                                            <h6>REMINDER</h6>
                                            <p>(Sample) Send the pricing quote</p>
                                            <a data-toggle="modal" href="#addMaterialModal" class="nav-link text-center custom-dashboard-nav-link navbar-cust-icons notification-user-initial" style="background-color: rgb(22, 110, 173) !important;"> <b>J</b> </a>
                                            <!-- <p>j</p> -->
                                        </div>
                                        <div class="col-md-2">
                                            <div class="notification-days">
                                                <span>2 Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle custom-dashboard-nav-link custom-dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <img src="{{ asset('img/smallogo.png') }}" class="rounded-circle img-thumbnail" alt="user" style="width: 32px; height: 32px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/admin/logout">
                            {{ __('Logout') }}
                            </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="pt-0">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
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
    $(document).ready(function () {
        $("#sidebars").mCustomScrollbar({
            theme: "minimal"
        });

        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
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
