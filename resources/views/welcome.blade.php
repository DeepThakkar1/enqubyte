<!-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ url('img/logo.png') }}" height="100px">
                </div>

                <div class="links">
                    <a href="javascript:;">Documentation</a>
                    <a href="javascript:;">Installation</a>
                    <a href="javascript:;">News</a>
                </div>
            </div>
        </div>
    </body>
</html>
 -->


 @extends('layouts.landing')

@section('content')
    <!-- END prelaoder -->
<!-- header section -->
{{-- <header class="xs-header header-transparent header-style2">
    <div class="container">
        <nav class="xs-menus clearfix">
            <div class="nav-header">
                <a class="nav-brand" href="/">
                    <img src="/img/logo.png" alt="">
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper align-to-right">
                <!-- menu list -->
                <!-- <ul class="nav-menu">
                    <li>
                        <a href="/index">Home</a>
                    </li>
                    <li>
                        <a href="/feature">Features</a>
                    </li>
                </ul>  -->               
                <!-- End menu list -->
                <ul class="xs-menu-tools">
                    <!-- <li>
                        <a href="#modal-popup-2" class="navsearch-button xs-modal-popup"><i class="icon icon-search"></i></a>
                    </li> -->
                    <li>
                        <a href="#" class="navSidebar-button"><i class="icon icon-burger-menu" style="font-size: 30px;"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- .container END -->
</header><!-- End header section --> --}}


@include('landing.navbar')


<!-- agency banner section -->
<section class="xs-banner agency-banner6 mt-4" id="homes" data-scrollax-parent="true">
    <div class="container">
        <div class="row home-banner-section">
            <div class="col-lg-7 align-self-center">
                <div class="agency-banner-content banner-style6">
                    <h2 class="banner-title"><span class="title-underline">Business</span> is the <span class="title-underline">salt of</span> life</h2>
                    <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli.</p>
                    <div class="banner-video-popups">
                        <a href="https://www.youtube.com/watch?v=BJq4d1-lHq8" class="xs-video-popup">
                            <i class="icon icon-play"></i>
                        </a>
                        <span>Take a Video Tour</span>
                    </div>
                </div><!-- .agency-banner-content END -->
            </div>
            <div class="col-lg-5">
                <div class="agency-banner-img responsive-agency-banner-img">
                    <img src="/img/homepage-01.svg" style="width: 100%;" data-scrollax="properties: { translateY: '50%' }" alt="">
                </div><!-- .agency-banner-img END -->
            </div>
        </div>
    </div><!-- .container END -->
    <div class="banner-icon-bg">
        <img src="/assets/images/welcome/welcome-icon-bg-3.png" alt="">
    </div>
</section><!-- end agency banner section -->

<!-- growth grid section -->
<section class="growth-card-section xs-section-padding custom-xs-section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="agency-section-title text-center style5">
                    <h2 class="main-title medium custom-main-title-heading">Forward into Growth</h2>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarks grove the headline of Alphabet Village</p>
                </div><!-- .agency-section-title .style3 END -->
            </div>
        </div><!-- .row END -->        
        <div class="row xs-mb-6">
            <div class="col-md-6 col-lg-3">
                <div class="info-card text-center">
                    <div class="info-card-header">
                        <img src="/assets/images/growth-icon-1.png" alt="">
                    </div>
                    <div class="info-card-body">
                        <h3 class="card-title">Business Relation</h3>
                        <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas</p>
                    </div>
                </div><!-- .info-card END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="info-card text-center">
                    <div class="info-card-header">
                        <img src="/assets/images/growth-icon-2.png" alt="">
                    </div>
                    <div class="info-card-body">
                        <h3 class="card-title">Business Relation</h3>
                        <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas</p>
                    </div>
                </div><!-- .info-card END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="info-card text-center">
                    <div class="info-card-header">
                        <img src="/assets/images/growth-icon-3.png" alt="">
                    </div>
                    <div class="info-card-body">
                        <h3 class="card-title">Business Relation</h3>
                        <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas</p>
                    </div>
                </div><!-- .info-card END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="info-card text-center">
                    <div class="info-card-header">
                        <img src="/assets/images/growth-icon-4.png" alt="">
                    </div>
                    <div class="info-card-body">
                        <h3 class="card-title">Business Relation</h3>
                        <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas</p>
                    </div>
                </div><!-- .info-card END -->
            </div>
        </div><!-- .row END -->
        <!-- <div class="btn-wraper text-center">
            <a href="#" class="simple-btn icon-right style2">View All Services <i class="icon icon-arrow-right"></i></a>
        </div> -->
    </div><!-- .container END -->
    <div class="growth-card-bg">
        <img src="/assets/images/growth-bg.png" alt="">
    </div>
</section><!-- end growth grid section -->

<!-- sucess history section -->
    <section class="waypoint-tigger success-history2-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="success-summary">
                    <div class="success-summary-content">
                        <i class="icon icon-coins-2 gradient-icon"></i>
                        <h3 class="content-title">A Satisfied Customer is best for business</h3>
                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                    <div class="piechats-wraper clearfix responsive-piechats-wraper">
                        <div class="single-piechart">
                            <div class="chart" data-percent="75">
                                <div class="chart-content"></div>
                            </div>
                            <p>WordPress</p>
                        </div><!-- .single-piechart END -->
                        <div class="single-piechart">
                            <div class="chart" data-percent="85">
                                <div class="chart-content"></div>
                            </div>
                            <p>iOS Apps</p>
                        </div><!-- .single-piechart END -->
                        <div class="single-piechart">
                            <div class="chart" data-percent="88">
                                <div class="chart-content"></div>
                            </div>
                            <p>Android</p>
                        </div><!-- .single-piechart END -->
                    </div>
                </div><!-- .success-summary END -->
            </div>
            <div class="col-lg-6">
                <div class="success-summary-image">
                    <img src="assets/images/relax-vector-img1.png" alt="">
                </div>
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section>    <!-- end sucess history section -->

<!-- deserve it section -->
<section class="deserve-it-area gradient-bg-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="deserve-summary-content text-center">
                    <h2 class="section-title">Really, You Deserve it</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
    <div class="background-wave-shape">
        <img src="assets/images/wave-shape-img.png" alt="">
    </div>
    <div class="pillow-image">
        <img src="assets/images/pillo-vector-image.png" alt="">
    </div>
</section><!-- end deserve it section -->

<!-- we offer section -->
<section class="we-offer-area">
    <div class="container">
        <div class="we-offer-wraper">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="single-we-offer wow fadeInLeft">
                        <div class="media">
                            <div class="we-offer-icon-wraper">
                                <i class="icon icon-payment we-offer-icon"></i>
                            </div>
                            <div class="media-body">
                                <h2 class="xs-title">Affordable Price Plans</h2>
                                <p>We work systematically to integrate corporate responsibility in our core business</p>
                            </div>
                        </div>
                    </div><!-- .single-we-offer END -->
                </div>
                <div class="col-md-6">
                    <div class="single-we-offer wow fadeInRight">
                        <div class="media">
                            <div class="we-offer-icon-wraper">
                                <i class="icon icon-rating we-offer-icon"></i>
                            </div>
                            <div class="media-body">
                                <h2 class="xs-title">Customer Satisfaction</h2>
                                <p>We work systematically to integrate corporate responsibility in our core business</p>
                            </div>
                        </div>
                    </div><!-- .single-we-offer END -->
                </div>
            </div><!-- .row END -->
        </div><!-- ."we-offer-wraper END -->
    </div><!-- .container END -->
</section><!-- end we offer section -->

<!-- more features area section -->
<section class="xs-section-padding-bottom gray-bg more-features-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">More Features</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end -->        
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn">
                    <div class="more-feature-header">
                        <img src="/img/icon/enquiry.png" alt="">
                    </div>
                    <h3 class="feature-title">Enquiries</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn" data-wow-delay=".2s">
                    <div class="more-feature-header">
                        <img src="/img/icon/products.png" alt="">
                    </div>
                    <h3 class="feature-title">Products & Stock</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn" data-wow-delay=".4s">
                    <div class="more-feature-header">
                        <img src="/img/icon/customers.png" alt="">
                    </div>
                    <h3 class="feature-title">Customers</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn" data-wow-delay=".6s">
                    <div class="more-feature-header">
                        <img src="/img/icon/sales.png" alt="">
                    </div>
                    <h3 class="feature-title">Sales</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn" data-wow-delay=".8s">
                    <div class="more-feature-header">
                        <img src="/img/icon/payout.png" alt="">
                    </div>
                    <h3 class="feature-title">Payouts & Incentives</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="single-more-feauture text-center wow fadeIn" data-wow-delay="1s">
                    <div class="more-feature-header">
                        <img src="/img/icon/campign.png" alt="">
                    </div>
                    <h3 class="feature-title">Campaigns</h3>
                    <p>We work systematically to integrate corporate responsibility in our core business</p>
                </div><!-- .single-more-feauture END -->
            </div>
        </div><!-- .row END -->
        <div class="btn-wraper text-center">
            <a href="/features" class="btn btn-primary btn-gradient4 icon-right">View all features <i class="icon icon-arrow-right"></i></a>
        </div>
    </div><!-- .container END -->
</section><!-- more features area section end -->

<!-- call to action section -->
<section class="calltoaction-area-2 version-gradient" data-delighter="start:0.80" style="background-image: url(assets/images/call-to-action-2.jpg);">
    <div class="container">
        <div class="call-to-action-wraper">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="call-to-action text-center action-style2">
                        <h2 class="content-title">Wanna Get New Test of Modern Web Design Trend?</h2>
                        <a href="/register" class="btn btn-primary btn-gradient4 icon-right">Get Started Now</a>
                        <!-- <a href="{{ route('register') }}" class="btn btn-primary style5 icon-right">Get Started Now<i class="icon icon-arrow-right"></i></a> -->
                    </div>
                </div>
            </div><!-- .row END -->
            <div class="content-over-img-wraper">
                <img src="assets/images/call-to-action-over-img-1.png" class="content-over-img img-1" alt="">
                <img src="assets/images/call-to-action-over-img-2.png" class="content-over-img img-2" alt="">
            </div>
        </div><!-- .call-to-action-wraper END -->
    </div><!-- .container END -->
    <div class="xs-overlay"></div>
</section><!-- call to action section end -->

<!-- footer section start -->
        <footer class="xs-footer-section footer-style5" data-delighter="start:0.80">
            <div class="footer-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget">
                                <div class="footer-logo-wraper">
                                    <a href="index-2.html" class="footer-logo responsive-footer-logo">
                                        <img src="/img/logo.png" alt="">
                                    </a>
                                </div>
                            </div><!-- .footer-widget END -->
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="footer-widget">
                                <h4 class="widget-title">Features</h4>
                                <ul class="xs-list">
                                    <li><a href="/features#Sales">Sales</a></li>
                                    <li><a href="/features#Enquirers">Enquiry</a></li>
                                    <li><a href="/features#Reports & Graphs">Reports & Graphs</a></li>
                                    <li><a href="/features#Campaigns">Campaigns</a></li>
                                    <li><a href="/features#Payouts & Incentives">Payouts & Incentives</a></li>
                                </ul><!-- .xs-list END -->
                            </div><!-- .footer-widget END -->
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="footer-widget">
                                <h4 class="widget-title">Company</h4>
                                <ul class="xs-list">
                                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="/terms-and-services">Terms of Service</a></li>
                                    <li><a href="#">About Trumpets</a></li>
                                    <!-- <li><a href="#">Knowledge Base</a></li>
                                    <li><a href="#">GDPR Update</a></li> -->
                                </ul><!-- .xs-list END -->
                            </div><!-- .footer-widget END -->
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="footer-widget">
                                <h4 class="widget-title">Social Media</h4>
                                <ul class="xs-list">
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">Twitter</a></li>
                                    <li><a href="#">Google Plus</a></li>
                                    <li><a href="#">Linkedin</a></li>
                                </ul><!-- .xs-list END -->
                            </div><!-- .footer-widget END -->
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget">
                                <h4 class="widget-title">Get Updates</h4>
                                <form action="#" method="POST" class="subscribe-form subscribe-from-style3">
                                    <label for="sub-input2"></label>
                                    <div class="form-group">
                                        <input type="email" name="email" id="sub-input2" placeholder="Enter your mail here..." class="form-control">
                                        <button class="sub-btn" type="submit"><i class="icon icon-right-arrow"></i></button>
                                    </div>
                                </form>
                                <div class="copyright-text">
                                    <p>Copyright 2018, Powered By<a href="https://trumpets.co.in/" target="_blank"> Trumpets</a>.</p>
                                </div>
                            </div><!-- .footer-widget END -->
                        </div>
                    </div><!-- .row END -->
                </div><!-- .container END -->
            </div><!-- .footer-top-area END -->
            <div class="wave-shape">
                <img src="assets/images/footer-wave-shape.png" alt="">
            </div>
        </footer>
        <!-- footer section end -->

        @endsection