<?php

namespace App\Http\Controllers;

use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;
use Lubusin\Mojo\Models\MojoRefundDetails;
use Lubusin\Mojo\Models\MojoPaymentDetails;

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
		return view('settings.billing', compact('transactions'));
	}
    public function success($paymentId = null, $requestId = null)
    {
    	$details = Mojo::giveMePaymentDetails();
    	if($details->payment->status == 'Credit')
    	{
    			$plan = PlanModel::where('name', $details->payment->purpose)->first();
    			$subscription = auth()->user()->subscribeTo($plan, $plan->duration); // 30 days

    			return redirect('subscribed');
    	} else {
    		return redirect('billing');
    	}


    }

    public function invoice($transactionId)
    {
    	$transaction = MojoPaymentDetails::where('id', $transactionId)->first();
    	return view('payments.invoice', compact('transaction'));
    }

    public function redirecting()
    {
    	$plan = PlanModel::where('name', auth()->user()->plan_name)->first();
            if(env('APP_ENV') != 'local'){
                $instamojoFormUrl =
                    Mojo::giveMeFormUrl(auth()->user(), $plan->price, $plan->name, '9922367414');
            } else {
                $subscription = auth()->user()->subscribeTo($plan, $plan->duration); // 30 days
                $instamojoFormUrl = '/subscribed';
            }

			return view('payments.redirecting', compact('instamojoFormUrl'));

    }

    public function upgrade()
    {
        return view('payments.upgrade');
    }

     public function changePlan()
    {
        $plan = PlanModel::where('name', request('plan'))->first();
            if(env('APP_ENV') != 'local'){
                $instamojoFormUrl =
                    Mojo::giveMeFormUrl(auth()->user(), $plan->price, $plan->name, '9922367414');
            } else {
                auth()->user()->subscriptions()->delete();
                $subscription = auth()->user()->subscribeTo($plan, $plan->duration); // 30 days
                $instamojoFormUrl = '/subscribed';
            }

            return view('payments.redirecting', compact('instamojoFormUrl'));
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

    	if(env('APP_ENV') != 'local') {
	        $transaction = MojoPaymentDetails::where('user_id', auth()->id())->latest()->first();
    	    Mojo::refund($transaction->payment_id, 'PTH','Subscription terminated');
    	}
    	flash('Your subscription was terminated and your amount will be refunded to you in 3 working days.')->success();

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
    		flash('Your subscription was activated successfully!')->success();
    		return redirect('billing');
    	} else {
			$plan = $subscription->plan;

    		if(env('APP_ENV') != 'local'){
                $instamojoFormUrl =
                    Mojo::giveMeFormUrl(auth()->user(), $plan->price, $plan->name, '9922367414');
                 return redirect($instamojoFormUrl);
            } else {
                $subscription = auth()->user()->subscribeTo($plan,  $plan->duration);
                return redirect('subscribed');
            }

    	}

    }
}
