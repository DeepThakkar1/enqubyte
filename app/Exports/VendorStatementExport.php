<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VendorStatementExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $vendors = auth()->user()->vendors;
        return view('exports.statements.vendors', compact('vendors'));
    }
}