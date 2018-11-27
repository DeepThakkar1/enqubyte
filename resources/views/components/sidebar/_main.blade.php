@push('css')
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/sidebar.css') }} " rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
@endpush


        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ url('img/logo.png') }}">
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/stores.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/stores-clr.png') }}" class="active-icon">
                        <span>{{ __('Stores') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/products.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/products-clr.png') }}" class="active-icon">
                        <span>{{ __('Products') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/reports.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/reports-clr.png') }}" class="active-icon">
                        <span>{{ __('Reports') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/settings.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/settings-clr.png') }}" class="active-icon">
                        <span>{{ __('Settings') }}</span>
                    </a>
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
                        <img src="{{ url('img/sidebar/logout.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/logout-clr.png') }}" class="active-icon">
                        <span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <ul class="social-links">
                <li class="border-right">
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/facebook.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/facebook-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li class="border-right">
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/instagram.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/instagram-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li class="border-right">
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/twitter.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/twitter-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/linkedin.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/linkedin-clr.png') }}" class="active-icon">
                    </a>
                </li>
            </ul>
        </nav>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
@endpush