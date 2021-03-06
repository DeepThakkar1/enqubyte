<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $stores = auth()->user()->stores;
        $products = auth()->user()->products;
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
        flash('Product added successfully!')->success();
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

        $invoiceIds =  collect($invoices)->pluck('id');
        $productTotal = InvoiceItem::whereIn('invoice_id', $invoiceIds)->where('product_id', $product->id)->sum('product_tot_amt');
        $qtySold = InvoiceItem::whereIn('invoice_id', $invoiceIds)->where('product_id', $product->id)->sum('qty');


        return view('products.show', compact('product', 'enquiries', 'invoices', 'productTotal','qtySold'));
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
        $newData = $request->all();
        if (!$newData['has_stock']) {
            $newData['has_stock'] = 0;
        }
        $product->update($newData);
        flash('Product updated successfully!')->success();
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
        flash('Product deleted successfully!')->error();
        return back();
    }

    public function exportToExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function exportToPDF(){
         return Excel::download(new ProductsExport(), 'products.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportToCSV(){
         return Excel::download(new ProductsExport(), 'products.csv',  \Maatwebsite\Excel\Excel::CSV);
    }
}
