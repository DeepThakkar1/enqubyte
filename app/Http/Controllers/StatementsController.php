<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use App\Exports\CashFlowExport;
use App\Exports\ProductStatementExport;
use App\Exports\CustomersStatementExport;
use App\Exports\VendorStatementExport;
use App\Exports\ProfitAndLossExport;
use Maatwebsite\Excel\Facades\Excel;

class StatementsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'subscribed']);
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
        $employeeIds =  collect($employees)->pluck('id');
        $totalIncentive = auth()->user()->invoices()->sum('incentive_amt');
        $totalPaidIncentive = IncentiveTransaction::whereIn('employee_id', $employeeIds)->groupBy('employee_id')->sum('amount');
        return view('statements.employee', compact('employees', 'totalIncentive', 'totalPaidIncentive'));
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
        if (request('start_date') && request('end_date')) {
            $totalSale = auth()->user()->invoices()->whereBetween('invoice_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->sum('grand_total');
            $totalPurchase = auth()->user()->purchases()->whereBetween('purchase_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->sum('grand_total');
            $incentives = auth()->user()->invoices()->whereBetween('invoice_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->sum('incentive_amt');
            $expenses = $totalPurchase + $incentives;
            $profit = $totalSale - $expenses;
        }else{
            $totalSale = auth()->user()->invoices->sum('grand_total');
            $totalPurchase = auth()->user()->purchases->sum('grand_total');
            $incentives = auth()->user()->invoices()->sum('incentive_amt');
            $expenses = $totalPurchase + $incentives;
            $profit = $totalSale - $expenses;
        }
        return view('statements.profit_loss_account', compact('expenses', 'profit', 'totalSale', 'totalPurchase', 'incentives'));
    }

    public function cashaccount()
    {
        if (request('start_date') && request('end_date')) {
            $employeeIds =  auth()->user()->employees->pluck('id');
            $incentives = IncentiveTransaction::whereIn('employee_id', $employeeIds)->whereBetween('created_at', [ Carbon::createFromFormat('d-m-Y', date('d-m-Y', strtotime(request('start_date')))), Carbon::createFromFormat('d-m-Y', date('d-m-Y', strtotime(request('end_date'))))])->sum('amount');
            $purchases = auth()->user()->purchases;
            $purchaseIds =  collect($purchases)->pluck('id');
            $totalPurchase = PurchaseOrderRecordPayment::whereIn('purchase_order_id', $purchaseIds)->whereBetween('payment_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->sum('amount');
            $invoices = auth()->user()->invoices;
            $invoiceIds =  collect($invoices)->pluck('id');
            $totalSale = RecordPayment::whereIn('invoice_id', $invoiceIds)->whereBetween('payment_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->sum('amount');
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

        return view('statements.cash_account', compact('expenses', 'profit', 'incentives', 'totalPurchase', 'totalSale'));
    }

    public function cashflowExcel()
    {
        return Excel::download(new CashFlowExport(), 'cashflow.xlsx');
    }

    public function cashflowPDF(){
         return Excel::download(new CashFlowExport(), 'cashflow.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function cashflowCSV(){
         return Excel::download(new CashFlowExport(), 'cashflow.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function customerStatementExcel()
    {
        return Excel::download(new CustomersStatementExport(), 'customerstatement.xlsx');
    }

    public function customerStatementPDF(){
         return Excel::download(new CustomersStatementExport(), 'customerstatement.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function customerStatementCSV(){
         return Excel::download(new CustomersStatementExport(), 'customerstatement.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function productStatementExcel()
    {
        return Excel::download(new ProductStatementExport(), 'productstatement.xlsx');
    }

    public function productStatementPDF(){
         return Excel::download(new ProductStatementExport(), 'productstatement.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function productStatementCSV(){
         return Excel::download(new ProductStatementExport(), 'productstatement.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function vendorStatementExcel()
    {
        return Excel::download(new VendorStatementExport(), 'vendorstatement.xlsx');
    }

    public function vendorStatementPDF(){
         return Excel::download(new VendorStatementExport(), 'vendorstatement.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function vendorStatementCSV(){
         return Excel::download(new VendorStatementExport(), 'vendorstatement.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function profitandlossExcel()
    {
        return Excel::download(new ProfitAndLossExport(), 'profitandloss.xlsx');
    }

    public function profitandlossPDF(){
         return Excel::download(new ProfitAndLossExport(), 'profitandloss.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function profitandlossCSV(){
         return Excel::download(new ProfitAndLossExport(), 'profitandloss.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function monthly()
    {

        // dd(auth()->user()->monthly_revenue_data);

        return view('statements.monthly');
    }

}
