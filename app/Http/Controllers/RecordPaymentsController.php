<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\RecordPayment;
use App\Notifications\InvoiceTransaction;

class RecordPaymentsController extends Controller
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
    public function store(Request $request, Invoice $invoice)
    {
        if ($request->amount && $invoice->remaining_amount >= floatval($request->amount)) {
            $invoice->remaining_amount -= floatval($request->amount);
            $invoice->save();
            $payment = $invoice->payments()->create($request->all());

            if(!$invoice->remaining_amount){
                $invoice->status = 1;
                $invoice->save();
            }

            // $invoice->customer->notify(new InvoiceTransaction($invoice, $payment, auth()->user()));

            return response(['invoice' => $invoice, 'payment' => $payment], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecordPayment  $recordPayment
     * @return \Illuminate\Http\Response
     */
    public function show(RecordPayment $recordPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecordPayment  $recordPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordPayment $recordPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecordPayment  $recordPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordPayment $recordPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecordPayment  $recordPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordPayment $recordPayment)
    {
        //
    }
}
