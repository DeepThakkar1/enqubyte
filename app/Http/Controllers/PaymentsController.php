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
		
    	return redirect('subscribed');

    }

    public function subscribed()
    {
    	return view('payments.subscribed');
    }
}
