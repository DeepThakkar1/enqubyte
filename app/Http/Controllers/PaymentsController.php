<?php

namespace App\Http\Controllers;

use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;

class PaymentsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

	public function index()
	{
		$transactions = Mojo::allPaymentsFor(auth()->user());
		dd($transactions);
		return view('settings.billing', compact('transactions'));
	}
    public function success($paymentId = null, $requestId = null)
    {
    	$details = Mojo::giveMePaymentDetails();
    	$plan = PlanModel::where('name', 'All-in-one monthly')->first();
    	$subscription = auth()->user()->subscribeTo($plan, 30); // 30 days
		
    	return redirect('subscribed');

    }

    public function subscribed()
    {
    	return view('payments.subscribed');
    }

    public function terminate()
    {
    	$subscription = auth()->user()->lastSubscription();

    	$subscription->update([
            'expires_on' => \Carbon\Carbon::now(),
        ]);

    	flash('Your subscription was terminated')->success();

    	return redirect('/billing');
    }

    public function cancel()
    {
    	auth()->user()->cancelCurrentSubscription();

    	flash('Your subscription was cancelled')->success();

    	return redirect('/billing');
    }

    public function renew()
    {
    	$subscription = auth()->user()->lastSubscription();

    	if($subscription->isPendingCancellation())
    	{
    		$subscription->update(['cancelled_on' => null]);
    		flash('Your subscription was activated successfully!');
    		return redirect('billing');
    	} else {
    		if(env('APP_ENV') != 'local'){
                $instamojoFormUrl = 
                    Mojo::giveMeFormUrl(auth()->user(), 1750, 'Monthly Subscription', '9922367414');
                 return redirect($instamojoFormUrl);
            } else {
                $plan = PlanModel::where('name', 'All-in-one monthly')->first();
                $subscription = auth()->user()->subscribeTo($plan, 30); // 30 days
                return redirect('subscribed');
            }
    		
    	}
    	   	 
    }
}
