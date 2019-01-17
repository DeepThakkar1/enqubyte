<?php

namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProfitAndLossExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (request('start_date') && request('end_date')) {
            $totalSale = auth()->user()->invoices()->whereBetween('invoice_date', [request('start_date'), request('end_date')])->sum('grand_total');
            $totalPurchase = auth()->user()->purchases()->whereBetween('purchase_date', [request('start_date'), request('end_date')])->sum('grand_total');
            $incentives = auth()->user()->invoices()->whereBetween('invoice_date', [request('start_date'), request('end_date')])->sum('incentive_amt');
            $expenses = $totalPurchase + $incentives;
            $profit = $totalSale - $expenses;
        }else{
            $totalSale = auth()->user()->invoices->sum('grand_total');
            $totalPurchase = auth()->user()->purchases->sum('grand_total');
            $incentives = auth()->user()->invoices()->sum('incentive_amt');
            $expenses = $totalPurchase + $incentives;
            $profit = $totalSale - $expenses;
        }
        return view('exports.statements.profit_loss_account', compact('expenses', 'profit', 'totalSale', 'totalPurchase', 'incentives'));
    }
}
