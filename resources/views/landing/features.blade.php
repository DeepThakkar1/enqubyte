@extends('layouts.landing')

@section('content')

@include('landing.navbar')

<!--breadcumb start here-->
<div class="xs-inner-banner inner-banner2" style=" margin-top: 63px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 align-self-center text-center features-section">
                    <div class="agency-banner-content banner-style3">
                        <h1 class="banner-title">Our Features</h1>
                        <!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which </p> -->
                        <a href="{{ route('register') }}" class="btn btn-primary btn-gradient4">Get Started Now</a>
                    </div><!-- .agency-banner-content END -->
                </div>
                <!-- <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="agency-banner-img">
                        <img src="assets/images/welcome/agency_welcome_2.png" data-scrollax="properties: { translateY: '25%' }" alt="agency banner image" draggable="false" style="transform: translateZ(0px) translateY(0%);">
                    </div>
                </div> -->
            </div><!-- .row END -->
        </div><!-- .container END -->
        <div class="scrollto-button-wraper">
            <a href="#masureofbusiness" class="scrollto-button round-btn"><i class="icon icon-download-arrow"></i></a>
        </div>
</div>
<!--breadcumb end here--><!-- End welcome section -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium1">
    <div class="container">
        <div id="enquiries">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Enquiries</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/PNG/Enquiry 2-01.png" alt="">
                </div>
            </div>
        </div><!-- .row END -->
        </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium5" style="background-color: #f3fbff;">
    <div class="container">
        <div id="products">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Products and Stock</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/Products n Stocks 2-01.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
        </div><!-- .row END -->
    </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium6">
    <div class="container">
        <div id="customers">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Customers</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/new/Customers 2-01.png" alt="" style="margin-top: -5px;">
                </div>
            </div>
        </div><!-- .row END -->
    </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium0" style="background-color: #f3fbff;">
    <div class="container">
        <div id="sales">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Sales</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/PNG/Sales-1.png" alt="" style="margin-top: -50px;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
        </div><!-- .row END -->
        </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->



<!-- business care area section -->
<section class="section-padding-medium section-padding-medium3">
    <div class="container">
        <div id="campaigns">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Campaigns</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/PNG/Campaign-2.png" alt="">
                </div>
            </div>
        </div><!-- .row END -->
    </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium4" style="background-color: #f3fbff;">
    <div class="container">
        <div id="payouts & Incentives">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Payouts & Incentives</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/PNG/Payouts-&-Incentives-2.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
        </div><!-- .row END -->
    </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->

<!-- business care area section -->
<section class="section-padding-medium section-padding-medium2">
    <div class="container">
        <div id="reports & Graphs">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Reports & Graphs</h2>
                    <p>We work systematically to integrate corporate responsibility in our core business We work systematically to integrate corporate responsibility in our core business</p>
                </div>
            </div>
        </div><!-- .row end --> 
        <div class="row">
            <div class="col-md-6">
                <div class="business-agenda-list">
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Increase your Business Analysis</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-2.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Real Time Invioce</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                    <div class="media single-business-agenda">
                        <div class="business-agenda-img">
                            <img src="assets/images/business-agenda/business-agenda-3.png" alt="">
                        </div>
                        <div class="media-body">
                            <h3 class="agenda-title">Perfect Timing</h3>
                            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
                        </div>
                    </div><!-- .single-business-agenda END -->
                </div><!-- .business-agenda-list END -->
            </div>
            <div class="col-md-6">
                <div class="business-care-img">
                    <img src="/img/PNG/Reports And Graphs 2-01.png" alt="">
                </div>
            </div>
        </div><!-- .row END -->
    </div>
    </div><!-- .container END -->
</section><!-- business care area section end -->


<!-- xs modal -->
<div class="zoom-anim-dialog mfp-hide modal-language" id="modal-popup-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="language-content">
                <p>Switch The Language</p>
                <ul class="flag-lists">
                    <li><a href="#"><img src="assets/images/flags/006-united-states.svg" alt=""><span>English</span></a></li>
                    <li><a href="#"><img src="assets/images/flags/002-canada.svg" alt=""><span>English</span></a></li>
                    <li><a href="#"><img src="assets/images/flags/003-vietnam.svg" alt=""><span>Vietnamese</span></a></li>
                    <li><a href="#"><img src="assets/images/flags/004-france.svg" alt=""><span>French</span></a></li>
                    <li><a href="#"><img src="assets/images/flags/005-germany.svg" alt=""><span>German</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- End xs modal --><!-- end language switcher strart -->

<!-- search panel strart -->
<!-- xs modal -->
<div class="zoom-anim-dialog mfp-hide modal-searchPanel" id="modal-popup-2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="xs-search-panel">
                <form action="#" method="POST" class="xs-search-group">
                    <input type="search" class="form-control" name="search" id="search" placeholder="Search">
                    <button type="submit" class="search-button"><i class="icon icon-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End xs modal --><!-- end search panel strart -->

@include('landing.footer')

        @endsection