<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Customer;
use App\Models\EnquiryItem;
use Illuminate\Http\Request;

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
        $customers = Customer::all();
        $products = Product::all();
        $enquiry =Enquiry::orderBy('created_at', 'desc')->first();
        return view('enquiries.create', compact('customers', 'products', 'enquiry'));
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
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'customer_id' => request('customer_id'),
            'followup_date' => request('followup_date'),
            'enquiry_date' => request('enquiry_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
            'grand_total' => request('grand_total')
        ]);
        for ($i=0; $i < count(request('product_id')); $i++) {
            $enquiry->enquiryitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => request('tax')[$i],
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}
