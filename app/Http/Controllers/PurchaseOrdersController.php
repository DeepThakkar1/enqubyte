<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseOrdersController extends Controller
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
        $purchases = auth()->user()->purchases;
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = auth()->user()->vendors;
        $products = auth()->user()->products;
        $purchaseSrno =PurchaseOrder::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
        return view('purchases.create', compact('vendors', 'products', 'purchaseSrno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scanCopy = '';
        if(request()->has('order_scan_copy'))
        {
            $scanCopy = request()->file('order_scan_copy')->store(
                '/uploads/purchaseorder/scancopy', 'public'
            );
        }

        $purchaseOrder = PurchaseOrder::create([
            'company_id' => auth()->id(),
            'sr_no' => request('sr_no'),
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'vendor_id' => request('vendor_id'),
            'order_id' => request('order_id'),
            'purchase_date' => request('purchase_date'),
            'due_date' => request('due_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
           /* 'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,*/
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total'),
            'order_scan_copy' => $scanCopy
        ]);
        for ($i=0; $i < count(request('product_id')); $i++) {
            $purchaseOrder->purchaseitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);

            $product = Product::where('id', request('product_id')[$i])->first();
            $product->stock += request('qty')[$i];
            $product->save();
        }

        flash('Purchase order added successfully!');
        return redirect('/purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchases.show', compact(('purchaseOrder')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $vendors = auth()->user()->vendors;
        $products = auth()->user()->products;
        $purchaseitems = $purchaseOrder->purchaseitems;
        return view('purchases.edit', compact('purchaseOrder', 'vendors', 'products', 'purchaseitems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $scanCopy = '';
        if(request()->has('order_scan_copy'))
        {
            $scanCopy = request()->file('order_scan_copy')->store(
                '/uploads/purchaseorder/scancopy', 'public'
            );
        }
        $purchaseOrder->update([
            'company_id' => auth()->id(),
            //'sr_no' => request('sr_no'),
            'order_id' => request('order_id'),
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'vendor_id' => request('vendor_id'),
            'purchase_date' => request('purchase_date'),
            'due_date' => request('due_date'),
            'sub_tot_amt' => request('sub_tot_amt'),
          /*  'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,*/
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total'),
            'order_scan_copy' => $scanCopy
        ]);

        foreach ($purchaseOrder->purchaseitems as $key => $item) {
            $product = Product::where('id', $item->product_id)->first();
            $product->stock -= $item->qty;
            $product->save();
        }

        $purchaseOrder->purchaseitems()->delete();

        for ($i=0; $i < count(request('product_id')); $i++) {
            $purchaseOrder->purchaseitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);

            $product = Product::where('id', request('product_id')[$i])->first();

            $product->stock += request('qty')[$i];
            $product->save();
        }

        flash('Purchase order updated successfully!');
        return redirect('/purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {

        foreach ($purchaseOrder->purchaseitems as $key => $item) {
            $product = Product::where('id', $item->product_id)->first();
            $product->stock -= $item->qty;
            $product->save();
        }
        $purchaseOrder->purchaseitems()->delete();
        $purchaseOrder->delete();
        flash('Purchase order deleted successfully!');
        return redirect('/purchases');
    }
}
