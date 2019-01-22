<?php

namespace App\Http\Controllers;

use App\Models\RequestDemo;
use Illuminate\Http\Request;

class RequestDemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        RequestDemo::create($request->all());
        return back();
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestDemo  $requestDemo
     * @return \Illuminate\Http\Response
     */
    public function show(RequestDemo $requestDemo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestDemo  $requestDemo
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestDemo $requestDemo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestDemo  $requestDemo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestDemo $requestDemo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestDemo  $requestDemo
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestDemo $requestDemo)
    {
        //
    }
}
