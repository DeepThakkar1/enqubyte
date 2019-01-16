<?php

namespace App\Exports;

use App\Models\Enquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EnquiriesExport implements FromView
{
    public function view(): View
    {
        return view('exports.enquiries', [
            'enquiries' => auth()->user()->enquiries
        ]);
    }
}