@extends('layouts.app')

@section('content')

<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents" style="border-bottom: solid 1px #f0f0f0;">
        <h2 class="d-inline-block headline-content"><span><a href="/home"> Home  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> <span><a href="/settings"> Settings  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Billing</h2>
    </div>
</div>

<div class="container-fluid pt-3">
	<div class="card">
	        <div class="card-body">
	            <div class="d-flex">
	                <div class="px-md-4">
	                	@if(auth()->user()->hasActiveSubscription() &&  auth()->user()->activeSubscription()->plan->price == 0)
	                		<h3 class="text-size-heading font-weight-bold">Subscription Active</h3>
			                    <div style="font-size: 20px;">Freemium Plan</div>
	                	@else
		                	@if(auth()->user()->hasActiveSubscription())
			                    <h3 class="text-size-heading font-weight-bold">Subscription Active</h3>
			                    <div style="font-size: 20px;">Plan : &#8377;{{ auth()->user()->activeSubscription()->plan->price}}/month | Days Remaining : {{ auth()->user()->activeSubscription()->remainingDays() }} </div>
			                @else
			                	@if(auth()->user()->lastSubscription() != null && auth()->user()->lastSubscription()->isPendingCancellation())
			                		<h3 class="text-size-heading font-weight-bold">Pending Cancellation</h3>
			                		<div style="font-size: 20px;">Plan : &#8377; {{ auth()->user()->lastSubscription()->plan->price}}/month | Days Remaining : {{ auth()->user()->lastSubscription()->remainingDays() }} </div>
			                	@else
			                		<h3 class="text-size-heading font-weight-bold">Subscription Cancelled</h3>
			                		<div style="font-size: 20px;">Plan : &#8377; 850/month   </div>
			                    @endif

		                    @endif
	                    @endif
	                </div>
	                <div class="ml-auto p-2">
	                	@if(auth()->user()->hasActiveSubscription() && auth()->user()->activeSubscription()->plan->price != 0)
		                	@if(auth()->user()->hasActiveSubscription())
		                		<a href="/subscription/upgrade" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-primary mr-2">Upgrade Subscription</a>
		                    	<a href="/subscription/cancel" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-danger">Cancel Subscription</a>
		                    @else
			                    @if(auth()->user()->lastSubscription() != null && auth()->user()->lastSubscription()->isPendingCancellation())
			                    <a href="/subscription/terminate" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-danger">Terminate Subscription</a>
			                    	<a href="/subscription/renew" style="font-size: 20px;" class="btn btn-outline-success">Revoke Subscription</a>
			                    @else
			                    	<a href="/subscription/renew" style="font-size: 20px;" class="btn btn-outline-success">Renew Subscription</a>
			                    @endif
		                    @endif
		                @else
		                	<a href="/subscription/upgrade" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-primary">Upgrade Subscription</a>
	                    @endif
	                </div>
	            </div>
	        </div>
	    </div>

	    @if(auth()->user()->hasActiveSubscription())
	    <h3 style="margin-top: 40px;">Usage</h3>
	    <hr>
	    <div class="card mt-4">
	        <div class="card-body">
	        	<div class="d-flex">
	                <div class="px-md-4">
	                	<h4>Enquiries</h4>
	                	<p class="pb-0 mb-0 text-dark" style="font-weight: 400;">Number of enquiries you have created.</p>
	                </div>
	                <div class="ml-auto p-2">
	                	<h4>{{ auth()->user()->activeSubscription()->getUsageOf('enquiries.count') }}/{{ auth()->user()->activeSubscription()->features()->code('enquiries.count')->first()->limit }}</h4>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="card mt-4">
	        <div class="card-body">
	        	<div class="d-flex">
	                <div class="px-md-4">
	                	<h4>Invoices</h4>
	                	<p class="pb-0 mb-0 text-dark" style="font-weight: 400;">Number of invoices you have created.</p>
	                </div>
	                <div class="ml-auto p-2">
	                	<h4>{{ auth()->user()->activeSubscription()->getUsageOf('invoices.count') }}/{{ auth()->user()->activeSubscription()->features()->code('invoices.count')->first()->limit }}</h4>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="card mt-4">
	        <div class="card-body">
	        	<div class="d-flex">
	                <div class="px-md-4">
	                	<h4>Purchases</h4>
	                	<p class="pb-0 mb-0 text-dark" style="font-weight: 400;">Number of purchases you have created.</p>
	                </div>
	                <div class="ml-auto p-2">
	                	<h4>{{ auth()->user()->activeSubscription()->getUsageOf('purchases.count') }}/{{ auth()->user()->activeSubscription()->features()->code('purchases.count')->first()->limit }}</h4>
	                </div>
	            </div>
	        </div>
	    </div>
	    @endif
	    @if(count($transactions))
	    <h3 style="margin-top: 40px;">Invoices from Enqubyte</h3>

	    <hr/>
	    @else
	    	<hr/>
	    @endif
	    @foreach($transactions as $transaction)
		    <div class="card">
		        <div class="card-body">
		            <div class="d-flex">
		                <div class="px-md-4">
		                	<h3 class="text-size-heading font-weight-bold">INV-00{{ $transaction->id }}</h3>
		                	<div style="font-size: 20px;">For the month of {{ $transaction->created_at->toFormattedDateString() }}</div>
		                </div>
			            <div class="ml-auto p-2">
	                        <a target="_blank" href="/billing/invoice/{{$transaction->id}}" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-primary">Download Invoice</a>
	                    </div>
                    </div>
		        </div>
		    </div>
	    @endforeach
</div>


@endsection