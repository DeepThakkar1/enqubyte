<?php

namespace App\Http\Controllers;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderRecordPayment;
use Illuminate\Http\Request;

class PurchaseOrderRecordPaymentController extends Controller
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
    public function store(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->remaining_amount -= floatval($request->amount);
        $purchaseOrder->save();
        $payment = $purchaseOrder->payments()->create($request->all());
        return response(['purchaseOrder' => $purchaseOrder, 'payment' => $payment], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrderRecordPayment  $purchaseOrderRecordPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrderRecordPayment $purchaseOrderRecordPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrderRecordPayment  $purchaseOrderRecordPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrderRecordPayment $purchaseOrderRecordPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrderRecordPayment  $purchaseOrderRecordPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrderRecordPayment $purchaseOrderRecordPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrderRecordPayment  $purchaseOrderRecordPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrderRecordPayment $purchaseOrderRecordPayment)
    {
        //
    }
}
