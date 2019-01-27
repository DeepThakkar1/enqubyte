@extends('layouts.app')

@section('content')

<!-- agency pricing section -->
<section id="pricing" class="xs-section-padding custome-xs-section-padding waypoint-tigger mb-5" style="background: #fdfdfd !important;">
    <div class="container">
        <div class="row section-title-style3">
            <div class="col-lg-8 mx-auto my-4">
                <div class="agency-section-title text-center">
                    <h3 class="main-title">Choose from flexible <em>Pricing Plans</em></h3>
                    <p style="font-size: 19px;color: #000;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="pricing-table text-center" id="svg-icon-1">
                    <div class="pricing-header">
                        <div class="xs-svg" data-svg="assets/images/pricing/pricing-1.svg" data-hover="#svg-icon-1"></div>
                        <h3>Free</h3>
                        <div class="pricing-price">
                            <h2>&#8377; 0</h2>
                            <span>/ MONTH</span>
                        </div>
                    </div><!-- .pricing-header END -->
                    <div class="pricing-body">
                        <ul class="pricing-list">
                            <li>10 Invoices & Enquiries</li>
                            <li>10 Purchase Orders</li>
                            <li>Unlimited Products</li>
                            <li>Unlimited Customers</li>
                            <li>Unlimited Visitors</li>
                        </ul>
                    </div><!-- .pricing-body END -->
                    <div class="pricing-footer">
                        @if(auth()->user()->activeSubscription()->plan->id == 1)
                            <a class="btn btn-outline-primary">Current Plan</a>
                        @else
                            <a href="/subscription/changeplan?plan=Free" class="btn btn-primary">Choose Plan</a>
                        @endif
                    </div><!-- .pricing-footer END -->
                </div><!-- .pricing-table END #svg-icon-1 end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="pricing-table text-center" id="svg-icon-1">
                    <div class="pricing-header">
                        <div class="xs-svg" data-svg="assets/images/pricing/pricing-1.svg" data-hover="#svg-icon-1"></div>
                        <h3>Adaptive</h3>
                        <div class="pricing-price">
                            <h2>&#8377; 450</h2>
                            <span>/ MONTH</span>
                        </div>
                    </div><!-- .pricing-header END -->
                    <div class="pricing-body">
                        <ul class="pricing-list">
                            <li>70 Invoices & Enquiries</li>
                            <li>50 Purchase Orders</li>
                            <li>Unlimited Products</li>
                            <li>Unlimited Customers</li>
                            <li>Unlimited Visitors</li>
                        </ul>
                    </div><!-- .pricing-body END -->
                    <div class="pricing-footer">
                        @if(auth()->user()->activeSubscription()->plan->id == 2)
                            <a href="#" class="btn btn-outline-primary">Current Plan</a>
                        @else
                            <a href="/subscription/changeplan?plan=Adaptive" class="btn btn-primary">Choose Plan</a>
                        @endif
                    </div><!-- .pricing-footer END -->
                </div><!-- .pricing-table END #svg-icon-1 end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="pricing-table text-center" id="svg-icon-2" style="border: 4px solid #1B6DAB;">
                    <span class="pricing-popular">Popular</span>
                    <div class="pricing-header">
                        <div class="xs-svg" data-svg="assets/images/pricing/pricing-2.svg" data-hover="#svg-icon-2"></div>
                        <h3>Growth</h3>
                        <div class="pricing-price">
                            <h2>&#8377; 850</h2>
                            <span>/ MONTH</span>
                        </div>
                    </div><!-- .pricing-header END -->
                    <div class="pricing-body">
                        <ul class="pricing-list">
                            <li>200 Invoices & Enquiries</li>
                            <li>200 Purchase Orders</li>
                            <li>Unlimited Products</li>
                            <li>Unlimited Customers</li>
                            <li>Unlimited Visitors</li>
                        </ul>
                    </div><!-- .pricing-body END -->
                    <div class="pricing-footer">
                        @if(auth()->user()->activeSubscription()->plan->id == 3)
                            <a class="btn btn-outline-primary">Current Plan</a>
                        @else
                            <a href="/subscription/changeplan?plan=Growth" class="btn btn-primary">Choose Plan</a>
                        @endif

                    </div><!-- .pricing-footer END -->
                </div><!-- .pricing-table END #svg-icon-1 end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="pricing-table text-center" id="svg-icon-3">
                    <div class="pricing-header">
                        <div class="xs-svg" data-svg="assets/images/pricing/pricing-3.svg" data-hover="#svg-icon-3"></div>
                        <h3>Enterprise</h3>
                        <div class="pricing-price">
                            <h2>&#8377; 1750</h2>
                            <span>/ MONTH</span>
                        </div>
                    </div><!-- .pricing-header END -->
                    <div class="pricing-body">
                        <ul class="pricing-list">
                            <li>Unlimited Invoices & Enquiries</li>
                            <li>Unlimited Purchase Orders</li>
                            <li>Unlimited Products</li>
                            <li>Unlimited Customers</li>
                            <li>Unlimited Visitors</li>
                        </ul>
                    </div><!-- .pricing-body END -->
                    <div class="pricing-footer">
                        @if(auth()->user()->activeSubscription()->plan->id == 4)
                            <a class="btn btn-outline-primary">Current Plan</a>
                        @else
                            <a href="/subscription/changeplan?plan=Enterprise" class="btn btn-primary">Choose Plan</a>
                        @endif
                    </div><!-- .pricing-footer END -->
                </div><!-- .pricing-table END #svg-icon-1 end -->
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section><!-- agency pricing section end -->

@endsection