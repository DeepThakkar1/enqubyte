<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\SalesmanIncentive;
use Illuminate\Http\Request;
use App\Notifications\NewInvoice;
use App\Notifications\UpdateInvoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
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
    public function index()
    {
        if (request('start_date') && request('end_date')) {
            $invoices = auth()->user()->invoices()->whereBetween('invoice_date', [request('start_date'), request('end_date')])->get();
        }else{
            $invoices = auth()->user()->invoices;
        }
        return view('sales.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesmans = auth()->user()->employees;
        $customers = auth()->user()->visitors;
        $products = auth()->user()->products;
        $invoiceSrno = Invoice::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
        return view('sales.invoices.create', compact('salesmans', 'customers', 'products', 'invoiceSrno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'invoice_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);

        for ($i=0; $i < count(request('product_id')); $i++) {
            $product = Product::where('id', request('product_id')[$i])->first();
            if ($product->stock < request('qty')[$i]) {
                flash('Stock not available for '. $product->name .'!');
                return back();
            }
        }

        $invoice = Invoice::create([
            'sr_no' => request('sr_no'),
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'due_date' => request('due_date'),
            'invoice_date' => request('invoice_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total')
        ]);

        $invoice->visitor->update(['is_customer' => 1]);

        for ($i=0; $i < count(request('product_id')); $i++) {
            $invoice->invoiceitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);

            $product = Product::where('id', request('product_id')[$i])->first();
            $product->stock -= request('qty')[$i];
            $product->save();
        }

        if(isset($invoice->employee) && $invoice->employee->incentive_id != 0){
            $incentiveAmt = 0;
            if ($invoice->employee->incentive->type == 1) {
                $incentiveAmt = $invoice->employee->incentive->rate;
            }else if ($invoice->employee->incentive->type == 2) {
                $incentiveAmt = (($invoice->grand_total * $invoice->employee->incentive->rate) / 100);
            }

            if ($invoice->grand_total >= $invoice->employee->incentive->minimum_invoice_amt) {
                $invoice->incentive_amt = $incentiveAmt;
                $invoice->save();
                $incentive = SalesmanIncentive::create([
                    'employee_id' => $invoice->employee_id,
                    'enquiry_id' => isset($invoice->enquiry_id) ? $invoice->enquiry_id : 0,
                    'invoice_id' => $invoice->id,
                    'incentive_amount' => $incentiveAmt,
                ]);
            }
        }

        $invoice->customer->notify(new NewInvoice($invoice, auth()->user()));

        flash('Invoice added successfully!');
        return redirect('/sales/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $invoice = auth()->user()->invoices->where('sr_no', $invoice)->first();
        return view('sales.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        if(count($invoice->payments)){
            flash("You didn't edit this invoice!");
            return redirect('/sales/invoices/'.$invoice->id);
        }
        else{
            $salesmans = auth()->user()->employees;
            $customers = auth()->user()->visitors;
            $products = auth()->user()->products;
            $invoiceitems = $invoice->invoiceitems;
            return view('sales.invoices.edit', compact('salesmans', 'invoice', 'customers', 'products', 'invoiceitems'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {

        $request->validate([
            'customer_id' => 'required',
            'invoice_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);

        for ($i=0; $i < count(request('product_id')); $i++) {
            $product = Product::where('id', request('product_id')[$i])->first();
            if ($product->stock < request('qty')[$i]) {
                flash('Stock not available for '. $product->name .'!');
                return back();
            }
        }

        $invoice->update([
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'due_date' => request('due_date'),
            'invoice_date' => request('invoice_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total')
        ]);

        foreach ($invoice->invoiceitems as $key => $item) {
            $product = Product::where('id', $item->product_id)->first();
            $product->stock += $item->qty;
            $product->save();
        }

        if (isset($invoice->invoiceitems)) {
            $invoice->invoiceitems()->delete();
        }

        if (isset($invoice->incentive)) {
            $invoice->incentive->delete();
        }

        if(isset($invoice->employee)){
            $incentiveAmt = 0;
            if ($invoice->employee->incentive->type == 1) {
                $incentiveAmt = $invoice->employee->incentive->rate;
            }else if ($invoice->employee->incentive->type == 2) {
                $incentiveAmt = (($invoice->grand_total * $invoice->employee->incentive->rate) / 100);
            }

            if ($invoice->grand_total >= $invoice->employee->incentive->minimum_invoice_amt) {
                $incentive = SalesmanIncentive::create([
                    'employee_id' => $invoice->employee_id,
                    'enquiry_id' => isset($invoice->enquiry_id) ? $invoice->enquiry_id : 0,
                    'invoice_id' => $invoice->id,
                    'incentive_amount' => $incentiveAmt,
                ]);
            }
        }

        for ($i=0; $i < count(request('product_id')); $i++) {
            $invoice->invoiceitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);

            $product = Product::where('id', request('product_id')[$i])->first();
            $product->stock -= request('qty')[$i];
            $product->save();
        }

        $invoice->customer->notify(new UpdateInvoice($invoice, auth()->user()));

        flash('Invoice updated successfully!');
        return redirect('/sales/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->invoiceitems()->delete();
        $invoice->delete();
        flash('Invoice deleted successfully!');
        return redirect('/sales/invoices');
    }

    public function exportToExcel(Request $request)
    {
        if($request){
            return Excel::download(new InvoicesExport($request->start_date, $request->end_date), 'invoices.xlsx');
        }else{
            return Excel::download(new InvoicesExport(), 'invoices.xlsx');
        }
    }
}
