<?php

namespace App\Http\Controllers;
use App\User;
use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;


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
            $instamojoFormUrl = Mojo::giveMeFormUrl(auth()->user(), 1750, 'Monthly Subscription', '9922367414');
            return redirect($instamojoFormUrl);
        }
       
        return view('home');
    }
}
