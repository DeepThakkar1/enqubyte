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
use App\Notifications\NewEnquiry;
use App\Notifications\UpdateEnquiry;
use App\Notifications\NewInvoice;

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
        if (request('start_date') && request('end_date')) {
            $enquiries = auth()->user()->enquiries()->whereBetween('enquiry_date', [request('start_date'), request('end_date')])->get();
        }else{
            $enquiries = auth()->user()->enquiries;
        }
        return view('enquiries.index', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = auth()->user()->visitors;
        $salesmans = auth()->user()->employees;
        $products = auth()->user()->products;
        $enquirySrno = Enquiry::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
        return view('enquiries.create', compact('salesmans', 'customers', 'products', 'enquirySrno'));
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
            'enquiry_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);
        $enquiry = auth()->user()->enquiries->create([
            'sr_no' => request('sr_no'),
            // 'company_id' => auth()->id(),
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

        $enquiry->customer->notify(new NewEnquiry($enquiry, auth()->user()));

        flash('Enquiry added successfully!');
        return redirect('/enquiries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show($enquiry)
    {
        dd(auth()->user()->enquiries);
        $enquiry = auth()->user()->enquiries->where('sr_no', $enquiry)->first();
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
        if($enquiry->status == 1 || $enquiry->status == -1)
        {
            flash("You didn't edit this enquiry!");
            return redirect('/enquiries/'.$enquiry->id);
        }
        else
        {
            $customers = auth()->user()->visitors;
            $salesmans = auth()->user()->employees;
            $products = auth()->user()->products;
            $enquiryitems = $enquiry->enquiryitems;
            return view('enquiries.edit', compact('salesmans', 'enquiry', 'customers', 'products', 'enquiryitems'));
        }
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
        $request->validate([
            'customer_id' => 'required',
            'enquiry_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);

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

        $enquiry->customer->notify(new UpdateEnquiry($enquiry, auth()->user()));

        flash('Enquiry updated successfully!');
        return redirect('/enquiries');
    }



    public function createInvoice(Enquiry $enquiry)
    {
        foreach ($enquiry->enquiryitems as $key => $item) {
            $product = Product::where('id', $item->product_id)->first();
            if ($product->stock < $item->qty) {
                flash('Only '. $product->stock . ' '.$product->name. ' available!');
                return back();
            }
        }

        $enquiry->update(['status' => 1]);
        $invoiceSrno = Invoice::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
        $invoice = Invoice::create([
            'sr_no' => $invoiceSrno,
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

        $enquiry->customer->update(['is_customer' => 1]);

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

        flash('Invoice created successfully!');
        return redirect('/sales/invoices/' . $invoice->id);
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

    public function changefollowupdate(Request $request, Enquiry $enquiry)
    {
        $enquiry->update(['followup_date' => $request->followup_date]);
        flash('Enquiry followup date updated successfully!');
        return redirect('/enquiries/'.$enquiry->id);
    }
}
