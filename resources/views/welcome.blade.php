@extends('layouts.landing')

@section('content')

@include('landing.navbar')

<!-- agency banner section -->
<section class="xs-banner agency-banner6 mt-4" id="homes" data-scrollax-parent="false">
    <div class="container">
        <div class="row home-banner-section">
            <div class="col-lg-7 align-self-center" style="padding-right: 30px;">
                <div class="agency-banner-content banner-style6">
                    <h2 class="banner-title">The perfect business assistant.</h2>
                    <p>Enqubyte is an all-in-one solution for managing a retail business at an ease providing features to handle enquiries, sales, purchases and employees as well as provide various reports that let's you analyse your business.</p>
                    <br>
                    <div class="get-started-section">
                        <input type="text" class="get-started" name="email" placeholder="E-mail Address">
                        <button class="btn btn-primary" style="margin-top: -2px;margin-left: 5px;">Get Started</button>    
                    </div>
                </div><!-- .agency-banner-content END -->
            </div>
            <div class="col-lg-5">
                <div class="agency-banner-img responsive-agency-banner-img">
                    <img src="/img/homepage-01.svg" style="width: 95%;" alt="">
                </div><!-- .agency-banner-img END -->
            </div>
        </div>
    </div><!-- .container END -->
   
</section><!-- end agency banner section -->

<!-- deserve it section -->
<section class="deserve-it-area" style="background: #1B6DAB;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="deserve-summary-content text-center">
                    <h2 class="section-title">What Enqubyte does?</h2>
                    <p style="font-size: 19px;">Enqubyte works systematically to integrate corporate responsibility in your business. Using Enqubyte for your business enhances the following two factors.</p>
                </div>
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
 
</section><!-- end deserve it section -->

<!-- we offer section -->
<section class="we-offer-area">
    <div class="container">
        <div class="we-offer-wraper">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="single-we-offer">
                        <div class="media">
                            <div class="we-offer-icon-wraper">
                                <i class="icon icon-payment we-offer-icon"></i>
                            </div>
                            <div class="media-body">
                                <h2 class="xs-title">Business Analysis &amp; Planning</h2>
                                <p style="color: #000;">A birds-eye view of your business to monthly, quaterly and yearly reports enhances the capability of better business decisions.</p>
                            </div>
                        </div>
                    </div><!-- .single-we-offer END -->
                </div>
                <div class="col-md-6">
                    <div class="single-we-offer">
                        <div class="media">
                            <div class="we-offer-icon-wraper">
                                <i class="icon icon-rating we-offer-icon"></i>
                            </div>
                            <div class="media-body">
                                <h2 class="xs-title">Customer Satisfaction</h2>
                                <p style="color: #000;">Email & SMS notifications to customers about their activity in your business makes them feel more connected and valued.</p>
                            </div>
                        </div>
                    </div><!-- .single-we-offer END -->
                </div>
            </div><!-- .row END -->
        </div><!-- ."we-offer-wraper END -->
    </div><!-- .container END -->
</section><!-- end we offer section --> 

<!-- more features area section -->
<section class="xs-section-padding-bottom more-features-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="agency-section-title text-center section-title-style2">                    
                    <h2 class="main-title">Central hub for your business</h2>
                    <p style="color:#000;font-size: 19px;">Forget the heck of maintaining your business records into multiple softwares for different purposes, Enqubyte covers everything your business needs all in one platform.</p>
                </div>
            </div>
        </div><!-- .row end -->        
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/customers.png" alt="">
                    </div>
                    <h3 class="feature-title">Visitors</h3>
                    <p>Keep a record of your daily walk-ins to the store and use those for marketing campaigns.</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/products.png" alt="">
                    </div>
                    <h3 class="feature-title">Products & Stock</h3>
                    <p>Easily manage &amp; store your vendors, purchase orders, products and stock.</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/enquiry.png" alt="">
                    </div>
                    <h3 class="feature-title">Enquiries</h3>
                    <p>Create Estimates & Enquiry sheets to keep a track of each lead or potential sale you can have.</p>
                </div><!-- .single-more-feauture END -->
            </div>
             <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/enquiry.png" alt="">
                    </div>
                    <h3 class="feature-title">Follow-ups</h3>
                    <p>Never loose a Enquiry/Lead with our follow-up management system.</p>
                </div><!-- .single-more-feauture END -->
            </div>
           
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/customers.png" alt="">
                    </div>
                    <h3 class="feature-title">Customers</h3>
                    <p>Maintain a seperate record of each customer that makes a purchase at your business.</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture" >
                    <div class="more-feature-header">
                        <img src="/img/icon/sales.png" alt="">
                    </div>
                    <h3 class="feature-title">Sales & Invoicing</h3>
                    <p>Create invoices with a click and record payments from customer in a systematic manner.</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/payout.png" alt="">
                    </div>
                    <h3 class="feature-title">Salesmen & Incentives</h3>
                    <p>Track progress of your employees with Salesmen linked enquiries and manage their incentives.</p>
                </div><!-- .single-more-feauture END -->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="single-more-feauture">
                    <div class="more-feature-header">
                        <img src="/img/icon/campign.png" alt="">
                    </div>
                    <h3 class="feature-title">Reports & Graphs</h3>
                    <p>Analysis is a key to enhancement in business. Analyse like a pro with our detailed reports.</p>
                </div><!-- .single-more-feauture END -->
            </div>
        </div><!-- .row END -->
        <div class="btn-wraper text-center" style="margin-top: 40px;">
            <a href="/features" class="btn btn-primary">Explore all features </a>
        </div>
    </div><!-- .container END -->
</section><!-- more features area section end -->

@include('landing.footer')



        @endsection