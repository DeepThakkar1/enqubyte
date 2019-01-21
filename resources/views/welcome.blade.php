@extends('layouts.landing')

@section('content')

@include('landing.navbar')

<!-- agency banner section -->
<section class="xs-banner agency-banner6 mt-4" id="homes" data-scrollax-parent="false">
    <div class="container">
        <div class="row home-banner-section">
            <div class="col-lg-7 align-self-center home-banner-headings">
                <div class="agency-banner-content banner-style6">
                    <h2 class="banner-title">The perfect business assistant.</h2>
                    <p>Enqubyte is an all-in-one solution for managing a retail business at an ease providing features to handle enquiries, sales, purchases and employees as well as provide various reports that let's you analyse your business.</p>
                    <br>
                    <div class="get-started-section">
                        <form method="GET" action="{{ route('register') }}">
                            <input type="text" class="get-started get-started-input" name="email" placeholder="E-mail Address">
                            <button type="submit" class="btn btn-primary custom-get-started-button" style="">Get Started</button>
                        </form>    
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
                            <div class="we-offer-icon-wraper responsive-icons-features">
                                <i class="icon icon-payment we-offer-icon"></i>
                            </div>
                            <div class="media-body custom-res-media-body">
                                <h2 class="xs-title">Business Analysis &amp; Planning</h2>
                                <p style="color: #000;">A birds-eye view of your business to monthly, quaterly and yearly reports enhances the capability of better business decisions.</p>
                            </div>
                        </div>
                    </div><!-- .single-we-offer END -->
                </div>
                <div class="col-md-6">
                    <div class="single-we-offer">
                        <div class="media">
                            <div class="we-offer-icon-wraper responsive-icons-features">
                                <i class="icon icon-rating we-offer-icon"></i>
                            </div>
                            <div class="media-body custom-res-media-body">
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
        <div class="btn-wraper text-center explore-all-features">
            <a href="/features" class="btn btn-primary">Explore all features </a>
        </div>
    </div><!-- .container END -->
</section><!-- more features area section end -->

<hr>
<section id="pricing" class="section-padding-medium desktop-enquiries section-padding-medium1">
        <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                <div class="agency-section-title section-title-style2">                    
                    <h2 class="main-title">Single &amp; Simple Pricing</h2>
                    <p class="simple-pricing-text">Enqubyte offers all its services and modules all in one single pricing. No plans, packages and upgrades. A semantic pricing is our key.</p>
                    <p class="simple-pricing-text">This plan allows you to create unlimited enquiries, invoices and orders. We provide <b>100 free SMS and 1000 free Email notifications / month</b> for customers. You can buy credits for extra SMS & Emails from dashboard.</p>

                    <div class=" get-started-now-button">    
                        <a href="/register" class="btn btn-primary">Get Started Now </a>
                    </div>
                </div>
            </div>
                    <div class="col-lg-4 col-md-6">
                <div class="pricing-table text-center" style="border-radius: 20px;padding-top: 0;" id="svg-icon-2">
                    <div class="pricing-header"> 
                        <div class="xs-svg" data-svg="assets/images/pricing/pricing-2.svg" data-hover="#svg-icon-2"></div>
                        <div style="border-top-left-radius: 20px;border-top-right-radius: 20px;background: #1B6DAB; padding-top: 10px;padding-bottom: 10px;margin-bottom: 40px;">
                        <h3 style="font-size: 34px; color: #fff;font-weight: 500;margin-bottom: 0;">All-in-one</h3>
                        </div>
                        <div class="pricing-price" style="padding-bottom: 0;color: #000;">
                            <h2><s>&#8377; 1,750</s> / month</h2>
                            <span style="margin-top: 10px;font-size: 19px;display: inline-block;color: green;font-weight: 500;">Avail the early release offer</span>

                            <span style="margin-top: 20px;width: 80%;font-size: 16px;display: inline-block;">Pay only <span style="font-size: 20px;color: #000;"><b>&#8377; 850 / month</b></span></span>
                        </div>
                    </div><!-- .pricing-header END -->
                </div><!-- .pricing-table END #svg-icon-1 end -->    
            </div>
                </div>    
        </div>    
</section>    

@include('landing.footer')



        @endsection