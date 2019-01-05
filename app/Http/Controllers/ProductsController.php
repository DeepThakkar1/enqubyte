<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        $stores = Store::all();
        $products = auth()->user()->products()->paginate(10);
        return view('products.index', compact('stores', 'products'));
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
        $product = auth()->user()->products()->create($newData);
        if($request->wantsJson())
        {
            return response($product, 200);
        }
        flash('Product added successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        /*$enquiries = \DB::select('enquiries.*','enquiry_items.enquiry_id','enquiry_items.product_id')
                            ->from('enquiries')
                            ->innerJoin('enquiry_items' , 'enquiry_items.enquiry_id', '=', 'enquiries.id')
                            ->where('enquiry_items.product_id', '=', $product->id)
                            ->get();*/
        $enquiries = \DB::select('select
          `enquiries`.*,
          `enquiry_items`.`enquiry_id`, `enquiry_items`.`product_id`
        from
          `enquiries`
          inner join `enquiry_items` on `enquiry_items`.`enquiry_id` = `enquiries`.`id`
        where
          `enquiry_items`.`product_id` = '.$product->id);

        $invoices = \DB::select('select
          `invoices`.*,
          `invoice_items`.`invoice_id`, `invoice_items`.`product_id`
        from
          `invoices`
          inner join `invoice_items` on `invoice_items`.`invoice_id` = `invoices`.`id`
        where
          `invoice_items`.`product_id` = '.$product->id);

        // dd($enquiries->products);
        return view('products.show', compact('product', 'enquiries', 'invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function get(Product $product)
    {
        return response($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        flash('Product updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        flash('Product deleted successfully!');
        return back();
    }
}
