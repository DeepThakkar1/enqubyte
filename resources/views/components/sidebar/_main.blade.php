@push('css')
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/sidebar.css') }} " rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
@endpush


        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center">Enqubyte</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#"><img src="{{ url('img/sidebar/dashboard.png') }}"> {{ __('Dashboard') }}</a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('img/sidebar/stores.png') }}"> {{ __('Stores') }}</a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('img/sidebar/products.png') }}"> {{ __('Products') }}</a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('img/sidebar/reports.png') }}"> {{ __('Reports') }}</a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('img/sidebar/settings.png') }}"> {{ __('Settings') }}</a>
                </li>

                <!-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li> -->

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <img src="{{ url('img/sidebar/logout.png') }}"> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
@endpush