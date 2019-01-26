<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Exports\PurchasesExport;
use Maatwebsite\Excel\Facades\Excel;
class PurchaseOrdersController extends Controller
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
        if (request('start_date') && request('end_date')) {
            $purchases = auth()->user()->purchases()->whereBetween('purchase_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->get();
        }else{
            $purchases = auth()->user()->purchases;
        }
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->activeSubscription()->getRemainingOf('purchases.count'))
        {
            flash('You need to upgrade to add more purchase orders.')->warning();
            return redirect('billing');
        }

        $vendors = auth()->user()->vendors;
        $products = auth()->user()->products()->where('has_stock', 1)->get();
        $purchaseSrno =PurchaseOrder::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;

        if(isset(auth()->user()->invoicetaxes)){
            $taxIds = explode(',', auth()->user()->invoicetaxes);
            $invoicetaxes = Tax::whereIn('id', $taxIds)->get();
            return view('purchases.create', compact('vendors', 'products', 'purchaseSrno', 'invoicetaxes'));
        }else{
            return view('purchases.create', compact('vendors', 'products', 'purchaseSrno'));
        }

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

        $purchaseSrno =PurchaseOrder::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;

        $taxes = [];
        if (request()->has('tax_amt') && count(request('tax_amt'))) {
            foreach (request('tax_amt') as $key => $tax_amt) {
                $taxes[] = [request('tax_abbrivation')[$key] => $tax_amt];
            }
        }


        $purchaseOrder = PurchaseOrder::create([
            'company_id' => auth()->id(),
            'sr_no' => $purchaseSrno,
            /*'employee_id' => 0,
            'store_id' => 0,*/
            'vendor_id' => request('vendor_id'),
            'order_id' => request('order_id'),
            'purchase_date' => date('d-m-Y', strtotime(request('purchase_date'))),
            'due_date' => date('d-m-Y', strtotime(request('due_date'))),
            'sub_tot_amt' => request('sub_tot_amt'),
           /* 'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,*/
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total'),
            'taxes' => json_encode($taxes),
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

        auth()->user()->activeSubscription()->consumeFeature('purchases.count', 1);

        flash('Purchase order added successfully!')->success();
        return redirect('/purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($purchaseOrder)
    {
        $purchaseOrder = auth()->user()->purchases->where('sr_no', $purchaseOrder)->first();
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
        $products = auth()->user()->products()->where('has_stock', 1)->get();;
        $purchaseitems = $purchaseOrder->purchaseitems;

        if(isset(auth()->user()->invoicetaxes)){
            $taxIds = explode(',', auth()->user()->invoicetaxes);
            $invoicetaxes = Tax::whereIn('id', $taxIds)->get();
            return view('purchases.edit', compact('purchaseOrder', 'vendors', 'products', 'purchaseitems', 'invoicetaxes'));
        }else{
            return view('purchases.edit', compact('purchaseOrder', 'vendors', 'products', 'purchaseitems'));
        }

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
        $taxes = [];
        if (request()->has('tax_amt') && count(request('tax_amt'))) {
            foreach (request('tax_amt') as $key => $tax_amt) {
                if (!$tax_amt) {
                    $taxes[] = [request('old_tax_abbrivation')[$key] => request('old_tax_amt')[$key]];
                }
                else{
                    $taxes[] = [request('tax_abbrivation')[$key] => $tax_amt];
                }
            }
        }
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
            'purchase_date' => date('d-m-Y', strtotime(request('purchase_date'))),
            'due_date' => date('d-m-Y', strtotime(request('due_date'))),
            'sub_tot_amt' => request('sub_tot_amt'),
          /*  'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,*/
            'grand_total' => request('grand_total'),
            'remaining_amount' => request('grand_total'),
            'taxes' => json_encode($taxes),
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

        flash('Purchase order updated successfully!')->success();
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
        flash('Purchase order deleted successfully!')->error();
        return redirect('/purchases');
    }

    public function exportToExcel(Request $request)
    {
        if($request){
            return Excel::download(new PurchasesExport($request->start_date, $request->end_date), 'purchases.xlsx');
        }else{
            return Excel::download(new PurchasesExport(), 'purchases.xlsx');
        }
    }

    public function exportToPDF(){
         return Excel::download(new PurchasesExport(), 'purchases.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportToCSV(){
         return Excel::download(new PurchasesExport(), 'purchases.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

    public function download(PurchaseOrder $purchaseOrder){
        $purchaseOrderPdf = \PDF::loadView('purchases.print', compact('purchaseOrder'));

        // return $purchaseOrderPdf->download('purchaseOrder.pdf');
        return view('purchases.print', compact('purchaseOrder'));
    }
}
