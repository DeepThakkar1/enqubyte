<?php

namespace App\Exports;

use App\Models\Visitors;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.customers', [
            'customers' => auth()->user()->visitors->where('is_customer', 1)->all()
        ]);
    }
}
