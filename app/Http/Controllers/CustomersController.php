<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $stores = auth()->user()->stores;
        $customers = auth()->user()->visitors()->where('is_customer', 1)->where('status', '!=', -1)->get();

        return view('customers.index', compact('stores', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newData = $request->all();
        $newData['company_id'] = auth()->id();
        $newData['is_customer'] = 1;
        $customer = auth()->user()->visitors()->create($newData);

        if($request->wantsJson())
        {
            return response([$customer], 200);
        }
        flash('Customer added successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {

        $enquiries = $visitor->enquiries;
        $enquiriesCount = $enquiries->count();
        $invoices = $visitor->invoices;
        $invoicesCount = $invoices->count();
        $totalSale = $invoices->sum('grand_total');
        $remaining = $invoices->sum('remaining_amount');

        return view('customers.show', compact('visitor', 'enquiries', 'enquiriesCount', 'invoicesCount', 'invoices', 'totalSale', 'remaining'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        $visitor->update($request->all());
        flash('Customer updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        $visitor->status = -1;
        $visitor->save();
        flash('Customer deleted successfully!');
        return back();
    }

    public function emailIsAvailable($email)
    {
        $isAvailable = !auth()->user()->customers()->where('email', $email)->exists();
        if ($isAvailable) {
            return response(['status'=>true], 200);
        }else{
            return response(['status'=>false], 404);
        }
    }

    public function exportToExcel()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

}
