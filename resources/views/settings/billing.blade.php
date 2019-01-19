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
	                	@if(auth()->user()->hasActiveSubscription())
		                    <h3 class="text-size-heading font-weight-bold">Subscription Active</h3>
		                    <div style="font-size: 20px;">Plan : &#8377; 1,750/month | Days Remaining : {{ auth()->user()->activeSubscription()->remainingDays() }} </div>
		                @else
		                	@if(auth()->user()->lastSubscription()->isPendingCancellation())
		                		<h3 class="text-size-heading font-weight-bold">Pending Cancellation</h3>
		                		<div style="font-size: 20px;">Plan : &#8377; 1,750/month | Days Remaining : {{ auth()->user()->lastSubscription()->remainingDays() }} </div>
		                	@else
		                		<h3 class="text-size-heading font-weight-bold">Subscription Cancelled</h3>
		                		<div style="font-size: 20px;">Plan : &#8377; 1,750/month   </div>
		                    @endif
		                    
	                    @endif
	                </div>
	                <div class="ml-auto p-2">
	                	@if(auth()->user()->hasActiveSubscription())
	                    	<a href="/subscription/cancel" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-danger">Cancel Subscription</a>
	                    @else
		                    @if(auth()->user()->lastSubscription()->isPendingCancellation())
		                    <a href="/subscription/terminate" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-outline-danger">Terminate Subscription</a>
		                    	<a href="/subscription/renew" style="font-size: 20px;" class="btn btn-outline-success">Revoke Subscription</a>	
		                    @else
		                    	<a href="/subscription/renew" style="font-size: 20px;" class="btn btn-outline-success">Renew Subscription</a>
		                    @endif	
	                    @endif	
	                </div>
	            </div>
	        </div>
	    </div>	

	    <h2 style="margin-top: 40px;">Invoices</h2>

	    <hr/>
	    
	    @foreach($transactions as $transaction)
		    <div class="card">
		        <div class="card-body">
		            <div class="d-flex">
		                <div class="px-md-4">
		                	<h3 class="text-size-heading font-weight-bold">INV-00{{ $transaction->id }}</h3>
		                	<div style="font-size: 20px;">For the month of {{ $transaction->created_at->toFormattedDateString() }}</div>
		                </div>	
			            <div class="ml-auto p-2">
	                        <a href="/billing/invoice/{{$transaction->id}}" style="font-size: 20px;padding-bottom: 40px;" class="btn btn-primary">Download Invoice</a>
	                    </div> 
                    </div>  	
		        </div>
		    </div>  
	    @endforeach      
</div>	


@endsection