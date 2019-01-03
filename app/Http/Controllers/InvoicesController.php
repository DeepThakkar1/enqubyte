<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Employee;
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
        $salesmans = auth()->user()->employees;
        $customers = Visitor::all();
        $products = Product::all();
        $invoice =Invoice::orderBy('created_at', 'desc')->first();
        dd($invoice);
        return view('sales.invoices.create', compact('salesmans', 'customers', 'products', 'invoice'));
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
        $salesmans = auth()->user()->employees;
        $customers = Visitor::all();
        $products = Product::all();
        $invoiceitems = $invoice->invoiceitems;
        return view('sales.invoices.edit', compact('salesmans', 'invoice', 'customers', 'products', 'invoiceitems'));
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
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'due_date' => request('due_date'),
            'invoice_date' => request('invoice_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'grand_total' => request('grand_total')
        ]);

        foreach ($invoice->invoiceitems as $key => $item) {
            $product = Product::where('id', $item->product_id)->first();
            $product->stock += $item->qty;
            $product->save();
        }

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

            $product = Product::where('id', request('product_id')[$i])->first();
            $product->stock -= request('qty')[$i];
            $product->save();
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
