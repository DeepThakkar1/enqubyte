<?php

namespace App\Exports;
use Illuminate\Http\Request;
use App\Models\RecordPayment;
use App\Models\IncentiveTransaction;
use App\Models\PurchaseOrderRecordPayment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CashFlowExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (request('start_date') && request('end_date')) {
            $employeeIds =  auth()->user()->employees->pluck('id');
            $incentives = IncentiveTransaction::whereIn('employee_id', $employeeIds)->whereBetween('created_at', [ Carbon::createFromFormat('d-m-Y', request('start_date')), Carbon::createFromFormat('d-m-Y', request('end_date'))])->sum('amount');
            $purchases = auth()->user()->purchases;
            $purchaseIds =  collect($purchases)->pluck('id');
            $totalPurchase = PurchaseOrderRecordPayment::whereIn('purchase_order_id', $purchaseIds)->whereBetween('payment_date', [request('start_date'), request('end_date')])->sum('amount');
            $invoices = auth()->user()->invoices;
            $invoiceIds =  collect($invoices)->pluck('id');
            $totalSale = RecordPayment::whereIn('invoice_id', $invoiceIds)->whereBetween('payment_date', [request('start_date'), request('end_date')])->sum('amount');
        }else{
            $employeeIds =  auth()->user()->employees->pluck('id');
            $incentives = IncentiveTransaction::whereIn('employee_id', $employeeIds)->sum('amount');
            $purchases = auth()->user()->purchases;
            $purchaseIds =  collect($purchases)->pluck('id');
            $totalPurchase = PurchaseOrderRecordPayment::whereIn('purchase_order_id', $purchaseIds)->sum('amount');
            $invoices = auth()->user()->invoices;
            $invoiceIds =  collect($invoices)->pluck('id');
            $totalSale = RecordPayment::whereIn('invoice_id', $invoiceIds)->sum('amount');
        }
        $expenses = $totalPurchase + $incentives;
        $profit = $totalSale - $expenses;

        return view('exports.statements.cashflow', compact('expenses', 'profit', 'incentives', 'totalPurchase', 'totalSale'));
    }
}
