<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Visitor;
use Illuminate\Http\Request;

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
        $invoices = auth()->user()->invoices;
        return view('sales.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Visitor::all();
        $products = Product::all();
        $invoive =Invoice::orderBy('created_at', 'desc')->first();
        return view('sales.invoices.create', compact('customers', 'products', 'invoive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'company_id' => auth()->id(),
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'customer_id' => request('customer_id'),
            'due_date' => request('due_date'),
            'invoice_date' => request('invoice_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'grand_total' => request('grand_total')
        ]);
        for ($i=0; $i < count(request('product_id')); $i++) {
            $invoice->invoiceitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

        flash('Invoice added successfully!');
        return redirect('/sales/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $customers = Visitor::all();
        $products = Product::all();
        $invoiceitems = $invoice->invoiceitems;
        return view('sales.invoices.edit', compact('invoice', 'customers', 'products', 'invoiceitems'));
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
        $invoice->update([
            'company_id' => auth()->id(),
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'customer_id' => request('customer_id'),
            'due_date' => request('due_date'),
            'invoice_date' => request('invoice_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'grand_total' => request('grand_total')
        ]);
        $invoice->invoiceitems()->delete();

        for ($i=0; $i < count(request('product_id')); $i++) {
            $invoice->invoiceitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

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
}
