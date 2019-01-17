<?php

namespace App\Exports;
use App\Models\InvoiceItem;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductStatementExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $products = auth()->user()->products;
        $invoices = auth()->user()->invoices;

        $invoiceIds =  collect($invoices)->pluck('id');
        $productTotal = InvoiceItem::whereIn('invoice_id', $invoiceIds)->groupBy('product_id')->sum('product_tot_amt');

        $statement = InvoiceItem::whereIn('invoice_id', $invoiceIds)->groupBy('product_id')->selectRaw('SUM(product_tot_amt) as revenue, SUM(qty) as qty_sold, product_id')->get();

        return view('exports.statements.products', compact('products', 'statement'));
    }
}