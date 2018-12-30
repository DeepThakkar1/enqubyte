@push('css')
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/sidebar.css') }} " rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
@endpush


        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="/home">
                <img src="{{ url('img/logo.png') }}">
            </a>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->is('home') ? 'active' : ''}}">
                    <a href="/home">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
               <!--  <li class="{{ request()->is('enquiries*') ? 'active' : ''}}">
                    <a href="/enquiries">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Enquiries') }}</span>
                    </a>
                </li> -->
                <li class="{{ request()->is('sales*') ? 'active' : ''}}">
                    <a href="#salesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <img src="{{ url('img/sidebar/sale.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/sale-clr.png') }}" class="active-icon">
                        <span>{{ __('Sales') }}</span>
                    </a>
                    <ul class="collapse list-unstyled" id="salesSubmenu">
                        <li>
                            <a href="/enquiries">{{ __('Enquiries') }}</a>
                        </li>
                        <li>
                            <a href="/sales/invoices">{{ __('Invoices') }}</a>
                        </li>
                         <li>
                            <a href="/customers">{{ __('Customers') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('purchases*') ? 'active' : ''}}">
                    <a href="#purchasesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <img src="{{ url('img/sidebar/purchase.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/purchase-clr.png') }}" class="active-icon">
                        <span>{{ __('Purchases') }}</span>
                    </a>
                    <ul class="collapse list-unstyled" id="purchasesSubmenu">
                        <li>
                            <a href="/purchases">{{ __('Purchase Orders') }}</a>
                        </li>
                        <li>
                            <a href="/vendors">{{ __('Vendors') }}</a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->mode)
                <li class="{{ request()->is('stores*') ? 'active' : ''}}">
                    <a href="/stores">
                        <img src="{{ url('img/sidebar/stores.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/stores-clr.png') }}" class="active-icon">
                        <span>{{ __('Stores') }}</span>
                    </a>
                </li>
                @endif
                <li class="{{ request()->is('products*') ? 'active' : ''}}">
                    <a href="#entitiesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Entities') }}</span>
                    </a>
                    <ul class="collapse list-unstyled" id="entitiesSubmenu">
                        <li>
                            <a href="/products">{{ __('Products') }}</a>
                        </li>
                        <li>
                            <a href="/employees">{{ __('Employees') }}</a>
                        </li>
                        <li>
                            <a href="/taxes">{{ __('Taxes') }}</a>
                        </li>
                    </ul>
                </li>
              <!--   <li class="{{ request()->is('products*') ? 'active' : ''}}">
                    <a href="/products">
                        <img src="{{ url('img/sidebar/products.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/products-clr.png') }}" class="active-icon">
                        <span>{{ __('Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('employees*') ? 'active' : ''}}">
                    <a href="/employees">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Employees') }}</span>
                    </a>
                </li> -->
                <li class="{{ request()->is('visitors*') ? 'active' : ''}}">
                    <a href="/visitors">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Visitors') }}</span>
                    </a>
                </li>
               <!--  <li class="{{ request()->is('customers*') ? 'active' : ''}}">
                    <a href="/customers">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Customers') }}</span>
                    </a>
                </li> -->
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/reports.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/reports-clr.png') }}" class="active-icon">
                        <span>{{ __('Reports') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('settings*') ? 'active' : ''}}">
                    <a href="/settings">
                        <img src="{{ url('img/sidebar/settings.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/settings-clr.png') }}" class="active-icon">
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>



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
                <li>
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/facebook.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/facebook-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/instagram.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/instagram-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li>
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
        <nav id="sidebars">
            <div class="sidebar-header">
                <a href="/home">
                <img src="{{ url('img/logo.png') }}">
            </a>
            <div id="dismiss">
                <svg class="svg-inline--fa fa-arrow-left fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path></svg><!-- <i class="fas fa-arrow-left"></i> -->
            </div>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->is('home') ? 'active' : ''}}">
                    <a href="/home">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('enquiries') ? 'active' : ''}}">
                    <a href="/enquiries">
                        <img src="{{ url('img/sidebar/dashboard.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/dashboard-clr.png') }}" class="active-icon">
                        <span>{{ __('Enquiries') }}</span>
                    </a>
                </li>

                @if(auth()->user()->mode)
                <li class="{{ request()->is('stores*') ? 'active' : ''}}">
                    <a href="/stores">
                        <img src="{{ url('img/sidebar/stores.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/stores-clr.png') }}" class="active-icon">
                        <span>{{ __('Stores') }}</span>
                    </a>
                </li>
                @endif
                <li class="{{ request()->is('products*') ? 'active' : ''}}">
                    <a href="/products">
                        <img src="{{ url('img/sidebar/products.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/products-clr.png') }}" class="active-icon">
                        <span>{{ __('Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('employees*') ? 'active' : ''}}">
                    <a href="/employees">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Employees') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('visitors*') ? 'active' : ''}}">
                    <a href="/visitors">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Visitors') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('customers*') ? 'active' : ''}}">
                    <a href="/customers">
                        <img src="{{ url('img/sidebar/employee.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/employee-clr.png') }}" class="active-icon">
                        <span>{{ __('Customers') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('img/sidebar/reports.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/reports-clr.png') }}" class="active-icon">
                        <span>{{ __('Reports') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('settings*') ? 'active' : ''}}">
                    <a href="/settings">
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
                <li>
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/facebook.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/facebook-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="{{ url('img/sidebar/instagram.png') }}" class="inactive-icon">
                        <img src="{{ url('img/sidebar/instagram-clr.png') }}" class="active-icon">
                    </a>
                </li>
                <li>
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
         <div class="overlay"></div>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
@endpush