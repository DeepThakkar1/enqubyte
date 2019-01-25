<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
class InvoiceExport implements FromView, ShouldAutoSize
{
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function view(): View
    {
        $invoice = auth()->user()->invoices()->where('id', $this->invoice)->first();
        return view('sales.invoices.print', compact('invoice'));
    }
}