<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EnquiryItem;
use Illuminate\Http\Request;
use App\Models\SalesmanIncentive;

class EnquiriesController extends Controller
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
        $enquiries = auth()->user()->enquiries;
        return view('enquiries.index', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Visitor::all();
        $salesmans = Employee::all();
        $products = Product::all();
        $enquiry =Enquiry::orderBy('created_at', 'desc')->first();
        return view('enquiries.create', compact('salesmans', 'customers', 'products', 'enquiry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enquiry = Enquiry::create([
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'followup_date' => request('followup_date'),
            'enquiry_date' => request('enquiry_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'grand_total' => request('grand_total')
        ]);
        for ($i=0; $i < count(request('product_id')); $i++) {
            $enquiry->enquiryitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

        flash('Enquiry added successfully!');
        return redirect('/enquiries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        return view('enquiries.show', compact('enquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        $salesmans = Employee::all();
        $customers = Visitor::all();
        $products = Product::all();
        $enquiryitems = $enquiry->enquiryitems;
        return view('enquiries.edit', compact('salesmans', 'enquiry', 'customers', 'products', 'enquiryitems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $enquiry->update([
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'followup_date' => request('followup_date'),
            'enquiry_date' => request('enquiry_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'grand_total' => request('grand_total')
        ]);
        $enquiry->enquiryitems()->delete();

        for ($i=0; $i < count(request('product_id')); $i++) {
            $enquiry->enquiryitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

        flash('Enquiry updated successfully!');
        return redirect('/enquiries');
    }



    public function createInvoice(Enquiry $enquiry)
    {
        $enquiry->update(['status' => 1]);
        $invoice = Invoice::create([
            'company_id' => auth()->id(),
            'employee_id' => !empty($enquiry->employee_id) ? $enquiry->employee_id : 0,
            // 'store_id' => 0,
            'customer_id' => $enquiry->customer_id,
            'enquiry_id' => $enquiry->id,
            'invoice_date' => date('d-m-Y'),
            'due_date' => date('d-m-Y'),
            'sub_tot_amt' => $enquiry->sub_tot_amt,
            'discount_type' => $enquiry->discount_type,
            'discount' => !empty($enquiry->discount) ? $enquiry->discount : 0,
            'grand_total' => $enquiry->grand_total,
            'remaining_amount' => $enquiry->grand_total
        ]);

        foreach ($enquiry->enquiryitems as $key => $item) {
            $invoice->invoiceitems()->create([
                'product_id' => $item->product_id,
                'description' => $item->description,
                'qty' => $item->qty,
                'price' => $item->price,
                'tax' => isset($item->tax) ? $item->tax : 0,
                'product_tot_amt' => $item->product_tot_amt
            ]);

            $product = Product::where('id', $item->product_id)->first();
            $product->stock -= $item->qty;
            $product->save();
        }

        $incentiveAmt = (($enquiry->grand_total * 10) / 100);

        $incentive = SalesmanIncentive::create([
            'employee_id' => $enquiry->employee_id,
            'enquiry_id' => $enquiry->id,
            'invoice_id' => $invoice->id,
            'incentive_amount' => $incentiveAmt,
        ]);

        flash('Invoice created successfully!');
        return redirect('/sales/invoices/' . $invoice->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->enquiryitems()->delete();
        $enquiry->delete();
        flash('Enquiry deleted successfully!');
        return redirect('/enquiries');
    }

    public function cancel(Enquiry $enquiry)
    {
        $enquiry->update(['status' => -1]);
        flash('Enquiry cancelled successfully!');
        return redirect('/enquiries');
    }
}
