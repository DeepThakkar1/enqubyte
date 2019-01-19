<?php

namespace App\Http\Controllers;
use App\User;
use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasActiveSubscription())
        {
            if(env('APP_ENV') != 'local'){
                $instamojoFormUrl = 
                    Mojo::giveMeFormUrl(auth()->user(), 1750, 'Monthly Subscription', '9922367414');
                 return redirect($instamojoFormUrl);
            } else {
                $plan = PlanModel::where('name', 'All-in-one monthly')->first();
                 $subscription = auth()->user()->subscribeTo($plan, 30); // 30 days
            }
            return redirect('subscribed');
        }

        return view('home');
    }
}
