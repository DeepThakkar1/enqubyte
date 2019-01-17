<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersStatementExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $customers = auth()->user()->visitors()->where('is_customer', 1)->get();
        return view('exports.statements.customer', compact('customers'));
    }
}