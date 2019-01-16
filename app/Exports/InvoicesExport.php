<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    public $start_date;
    public $end_date;
    protected $invoices;


    public function __construct($start_date = null, $end_date = null)
    {
        if (request('start_date') && request('end_date')) {
            $invoices = auth()->user()->invoices()->whereBetween('invoice_date', [request('start_date'), request('end_date')])->get();
        }else{
            $invoices = auth()->user()->invoices;
        }
    }

    public function view(): View
    {
        return view('exports.invoices', [
            'invoices' => auth()->user()->invoices
        ]);
    }
}