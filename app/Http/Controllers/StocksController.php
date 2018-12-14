<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class StocksController extends Controller
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
    public function store(Store $store, Product $product, Request $request)
    {
        $availableStock = Stock::where('store_id', $store->id)->where('product_id', $product->id)->first();
        if($availableStock){
            $stock = $availableStock->qty + intval(request('qty'));
            $stock = $availableStock->update(['qty' => $stock]);
            $product->update(['stock' => $product->stock - intval(request('qty'))]);
            $updatedStock = Stock::where('store_id', $store->id)->where('product_id', $product->id)->first();
            return response(['product' => $product, 'stock' => $updatedStock], 200);
        }else{
            auth()->user()->stocks()->create(['product_id' => $product->id, 'store_id' => $store->id, 'qty' => intval(request('qty'))]);
            $product->update(['stock' => $product->stock - intval(request('qty'))]);
            $updatedStock = Stock::where('store_id', $store->id)->where('product_id', $product->id)->first();
            return response(['product' => $product, 'stock' => $updatedStock], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
