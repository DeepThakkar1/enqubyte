<?php

namespace App\Http\Controllers;
use App\User;
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
        $this->middleware(['auth', 'verified', 'subscribed']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followups = auth()->user()->enquiries()->where('followup_date', date('d-m-Y'))->get();
        $enquiriesCnt = auth()->user()->enquiries()->count();
        $totalSale = auth()->user()->invoices()->sum('grand_total');
        $totalRemains = auth()->user()->invoices()->sum('remaining_amount');
        $totalEarned = $totalSale - $totalRemains;

        $totalPurchase = auth()->user()->purchases->sum('grand_total');
        $incentives = auth()->user()->invoices()->sum('incentive_amt');
        $expenses = $totalPurchase + $incentives;
        $profit = $totalSale - $expenses;

        $pendingEnqCnt = auth()->user()->enquiries()->where('status', 0)->count();
        $convertedEnqCnt = auth()->user()->enquiries()->where('status', 1)->count();
        $cancelledEnqCnt = auth()->user()->enquiries()->where('status', -1)->count();

        return view('home', compact('followups', 'enquiriesCnt', 'totalSale', 'totalPurchase', 'totalEarned', 'expenses', 'profit', 'pendingEnqCnt', 'convertedEnqCnt', 'cancelledEnqCnt'));

    }
}
