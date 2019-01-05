<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Visitor;
use App\Models\Employee;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
