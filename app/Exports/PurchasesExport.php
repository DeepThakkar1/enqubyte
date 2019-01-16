<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchasesExport implements FromView
{
    public $start_date;
    public $end_date;
    protected $purchases;


    public function __construct($start_date = null, $end_date = null)
    {
        if (request('start_date') && request('end_date')) {
            $purchases = auth()->user()->purchases()->whereBetween('purchase_date', [request('start_date'), request('end_date')])->get();
        }else{
            $purchases = auth()->user()->purchases;
        }
    }

    public function view(): View
    {
        return view('exports.purchases', [
            'purchases' => auth()->user()->purchases
        ]);
    }
}