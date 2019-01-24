<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxesController extends Controller
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
    public function index()
    {
        $taxes = auth()->user()->taxes()->paginate(10);
        return view('taxes.index', compact('taxes'));
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
        $tax = auth()->user()->taxes()->create($request->all());

        if($request->wantsJson())
        {
            return response([$tax], 200);
        }
        flash('Tax added successfully!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function get($tax)
    {
        $tax = auth()->user()->taxes()->where('rate', $tax)->first();
        return response($tax, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $tax->update($request->all());

        if($request->wantsJson())
        {
            return response([$tax], 200);
        }
        flash('Tax updated successfully!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        flash('Tax deleted successfully!')->error();
        return back();
    }

    public function abbreviationIsAvailable($abbreviation)
    {
        $isAvailable = !auth()->user()->taxes()->where('abbreviation', $abbreviation)->exists();
        if ($isAvailable) {
            return response(['status'=>true], 200);
        }else{
            return response(['status'=>false], 404);
        }
    }
}
