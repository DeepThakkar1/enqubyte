<nav class="navbar navbar-expand-lg navbar-light bg-light custom-dashboard-navbar">
 <button type="button" id="sidebarCollapse" class="btn btn-info custom-btn-info" style="outline:transparent;">
    <i class="fas fa-align-left"></i>
</button>
<button type="button" id="sidebarsCollapse" class="btn btn-info custom-btn-info-res" style="outline:transparent;">
    <i class="fas fa-align-left"></i>
</button>
<button class="navbar-toggler" type="button"  style="border:none;outline: transparent;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!-- <span class="navbar-toggler-icon"></span> -->
    <i class="fa fa-search" aria-hidden="true" style="outline: transparent;"></i>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 ml-3">
        <input class="form-control mr-sm-2 custom-search-input" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" style="height: 46px;">Search</button>
    </form>
    <ul class="navbar-nav ml-auto dashboard-nav-list">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle custom-dashboard-nav-link" data-toggle="modal" href="#addMaterialModal">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div> -->
        </li>
        <li class="nav-item active dropdown">
            <a href="#" class="nav-link dropdown-toggl custom-dashboard-nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell-o" aria-hidden="true" style="color: #000;font-size: 25px;margin-top: 9px;margin-right: 10px;"></i>
            </a>
            <ul class="dropdown-menu notify-drop">
                <div class="notify-drop-title">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">Notification (<b>2</b>)</div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <a href="" style="background-color: #fff;" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu.">
                                <i class="fa fa-dot-circle-o"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="drop-content dropdown-menu-right">
                    <li>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a>
                                <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                <hr>
                                <p class="time">Şimdi</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a>
                                <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                <p class="time">1 Saat önce</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a>
                                <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                <p class="time">29 Dakika önce</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a>
                                <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                <p class="time">Dün 13:18</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img">
                                    <img src="http://placehold.it/45x45" alt="">
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <a href="">Ahmet</a> yorumladı.
                                <a href="">Çicek bahçeleri...</a>
                                <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                <p class="time">2 Hafta önce</p>
                            </div>
                        </div>
                    </li>
                </div>
                <!-- <div class="notify-drop-footer text-center">
                    <a href=""><i class="fa fa-eye"></i> Tümünü Göster</a>
                </div> -->
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle custom-dashboard-nav-link custom-dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/assets/images/team/team-1.jpg" class="rounded-circle" alt="user" style="width: 40px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Demo Link</a>
                <a class="dropdown-item" href="#">Demo Link</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/settings">Settings</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> -->
        </ul>
    </div>
</nav>


<div class="modal fade in addProductModal" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body p-0">
                <div class="entity-section">
                    <h5 class="bg-light p-2" style="font-size: 15px;text-transform: uppercase;">Products</h5>
                </div>
                <div class="pt-3 pb-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <a href="/employees">
                                <img src="/img/icons/hired.png" alt="icons">
                                <p>Employees</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/visitors">
                                <img src="/img/icons/visitor.png" alt="icons">
                                <p>Visitors</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/customers">
                                <img src="/img/icons/customer.png" alt="icons">
                                <p>Customers</p>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="#">
                                <img src="/img/icons/reports.png" alt="icons">
                                <p>Reports</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="entity-section">
                    <h5 class="bg-light p-2" style="font-size: 15px;text-transform: uppercase;">Enquiries</h5>
                </div>
                <div class="pt-3 pb-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <img src="/img/icons/responsive.png" alt="icons">
                            <p>Sales</p>
                        </div>
                        <div class="col-md-3">
                            <img src="/img/icons/appointment.png" alt="icons">
                            <p>Enquiries</p>
                        </div>
                        <div class="col-md-3">
                            <img src="/img/icons/customer-service.png" alt="icons">
                            <p>Purchase</p>
                        </div>
                       <!--  <div class="col-md-3">
                            <img src="/img/icons/chat.png" alt="icons">
                            <p>SMS</p>
                        </div> -->
                    </div>
                </div>

              <!--   <div class="entity-section">
                    <h5 class="bg-light p-2" style="font-size: 15px;text-transform: uppercase;">Reports</h5>
                </div>
                <div class="pt-3 pb-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <img src="/img/icons/report.png" alt="icons">
                            <p>Report</p>
                        </div>
                        <div class="col-md-3">
                            <img src="/img/icons/home.png" alt="icons">
                            <p>Dashboards</p>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="entity-section">
                    <h5 class="bg-light p-2" style="font-size: 15px;text-transform: uppercase;">Email</h5>
                </div>
                <div class="pt-3 pb-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <img src="/img/icons/email.png" alt="icons">
                            <p>Send email</p>
                        </div>
                        <div class="col-md-3">
                            <img src="/img/icons/web-design.png" alt="icons">
                            <p>Templates</p>
                        </div>
                        <div class="col-md-3">
                            <img src="/img/icons/digital-campaign.png" alt="icons">
                            <p>Campaigns</p>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>