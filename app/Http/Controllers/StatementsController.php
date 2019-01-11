<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Incentive;
use App\Models\InvoiceItem;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\RecordPayment;
use App\Models\IncentiveTransaction;
use App\Models\PurchaseOrderRecordPayment;

class StatementsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        $customers = auth()->user()->visitors()->where('is_customer', 1)->get();
        return view('statements.customer', compact('customers'));
    }

    public function customerShow(Visitor $customer)
    {
        return view('statements.showcustomer', compact('customer'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor()
    {
        $vendors = auth()->user()->vendors;
        return view('statements.vendor', compact('vendors'));
    }

    public function vendorShow(Vendor $vendor)
    {
        return view('statements.showvendor', compact('vendor'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee()
    {
        $employees = auth()->user()->employees;
        return view('statements.employee', compact('employees'));
    }

    public function salesmanShow(Employee $employee)
    {
        return view('statements.showemployee', compact('employee'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $products = auth()->user()->products;
        $invoices = auth()->user()->invoices;

        $invoiceIds =  collect($invoices)->pluck('id');
        $productTotal = InvoiceItem::whereIn('invoice_id', $invoiceIds)->groupBy('product_id')->sum('product_tot_amt');

        $statement = InvoiceItem::whereIn('invoice_id', $invoiceIds)->groupBy('product_id')->selectRaw('SUM(product_tot_amt) as revenue, SUM(qty) as qty_sold, product_id')->get();

        return view('statements.product', compact('products', 'statement'));
    }

    public function profitandloss()
    {
        $totalSale = auth()->user()->invoices->sum('grand_total');
        $totalPurchase = auth()->user()->purchases->sum('grand_total');
        $employeeIds =  auth()->user()->employees->pluck('id');
        $invoiceIds =  auth()->user()->invoices->pluck('id');
        $incentives = auth()->user()->invoices()->sum('incentive_amt');
        $expenses = $totalPurchase + $incentives;
        $profit = $totalSale - $expenses;
        return view('statements.profit_loss_account', compact('expenses', 'profit', 'totalSale', 'totalPurchase', 'incentives'));
    }

    public function cashaccount()
    {
        $employeeIds =  auth()->user()->employees->pluck('id');
        $incentives = IncentiveTransaction::whereIn('employee_id', $employeeIds)->sum('amount');

        $purchases = auth()->user()->purchases;
        $purchaseIds =  collect($purchases)->pluck('id');
        $totalPurchase = PurchaseOrderRecordPayment::whereIn('purchase_order_id', $purchaseIds)->sum('amount');

        $invoices = auth()->user()->invoices;
        $invoiceIds =  collect($invoices)->pluck('id');
        $totalSale = RecordPayment::whereIn('invoice_id', $invoiceIds)->sum('amount');

        $expenses = $totalPurchase + $incentives;
        $profit = $totalSale - $expenses;

        return view('statements.cash_account', compact('expenses', 'profit', 'incentives', 'totalPurchase', 'totalSale'));
    }

}
