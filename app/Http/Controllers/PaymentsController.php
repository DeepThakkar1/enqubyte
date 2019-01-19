<?php

namespace App\Http\Controllers;

use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;

class PaymentsController extends Controller
{
    public function success($paymentId = null, $requestId = null)
    {
    	$details = Mojo::giveMePaymentDetails();
    	$plan = PlanModel::where('name', 'All-in-one monthly')->first();
    	$subscription = auth()->user()->subscribeTo($plan, 30); // 30 days
		
    	flash()->overlay('Your payment was successfull! You are subscribed to all-in-one monthly plan and your subscription expires in ' . $subscription->remainingDays() . ' days', 'Account subscription activated');

    	return redirect('home');
    }
}
