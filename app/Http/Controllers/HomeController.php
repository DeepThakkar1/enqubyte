<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Incentive;
use App\Models\EnquiryItem;
use App\Models\InvoiceItem;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\SalesmanIncentive;

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
        if(!auth()->user()->account_setup)
            return redirect('setup');

        $followups = auth()->user()->enquiries()->where('followup_date', date('d-m-Y'))->where('status', 0)->get();
        $enquiriesCnt = auth()->user()->enquiries()->count();
        $totalSale = auth()->user()->invoices()->sum('grand_total');
        $totalRemains = auth()->user()->invoices()->sum('remaining_amount');
        $totalEarned = $totalSale - $totalRemains;

        $totalPurchase = auth()->user()->purchases->sum('grand_total');
        $incentives = auth()->user()->invoices()->sum('incentive_amt');
        $dueInvoices = auth()->user()->invoices()->where('due_date', '<=', date('d-m-Y'))->where('remaining_amount', '!=', 0)->get();
        $expenses = $totalPurchase + $incentives;
        $profit = $totalSale - $expenses;

        $pendingEnqCnt = auth()->user()->enquiries()->where('status', 0)->count();
        $convertedEnqCnt = auth()->user()->enquiries()->where('status', 1)->count();
        $cancelledEnqCnt = auth()->user()->enquiries()->where('status', -1)->count();

        return view('home', compact('followups', 'enquiriesCnt', 'totalSale', 'totalPurchase', 'totalEarned', 'expenses', 'profit', 'pendingEnqCnt', 'convertedEnqCnt', 'cancelledEnqCnt','dueInvoices'));

    }

    public function showSetup()
    {
        return view('setup');
    }

    public function setup()
    {

        if(!auth()->user()->account_setup)
        {
            // Add Default Taxes
            auth()->user()->taxes()->delete();
            auth()->user()->taxes()->create(['name' => 'CGST', 'abbreviation' => 'CGST(9%)', 'rate' => 9]);
            auth()->user()->taxes()->create(['name' => 'SGST', 'abbreviation' => 'SGST(9%)', 'rate' => 9]);

            auth()->user()->account_setup = 1;
            auth()->user()->taxmode = 0;
            auth()->user()->invoicetaxes = implode(',', auth()->user()->taxes()->pluck('id')->toArray());
            auth()->user()->save();

            auth()->user()->reportfrequency()->delete();
            $reportsSettings['monthly'] =  1;
            $reportsSettings['yearly'] =  1;
            auth()->user()->reportfrequency()->create($reportsSettings);
       }

        return response(['success', 200]);
    }

    public function reset()
    {
        $invoices = auth()->user()->invoices;
        $invoiceIds =  collect($invoices)->pluck('id');
        InvoiceItem::whereIn('invoice_id', $invoiceIds)->delete();
        SalesmanIncentive::whereIn('invoice_id', $invoiceIds)->delete();
        auth()->user()->invoices()->delete();

        $enquiries = auth()->user()->enquiries;
        $enquiryIds =  collect($enquiries)->pluck('id');
        EnquiryItem::whereIn('enquiry_id', $enquiryIds)->delete();
        auth()->user()->enquiries()->delete();

        $purchases = auth()->user()->purchases;
        $purchaseIds =  collect($purchases)->pluck('id');
        PurchaseItem::whereIn('purchase_order_id', $purchaseIds)->delete();
        auth()->user()->purchases()->delete();

        auth()->user()->customers()->delete();
        auth()->user()->employees()->delete();
        auth()->user()->vendors()->delete();
        auth()->user()->products()->delete();
        auth()->user()->incentives()->delete();
        auth()->user()->taxes()->delete();
        auth()->user()->reportfrequency()->delete();

        auth()->user()->account_setup = 0;
        auth()->user()->save();

        return redirect('setup');
    }
}
