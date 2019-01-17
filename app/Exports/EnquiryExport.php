<?php

namespace App\Exports;

use App\Models\Enquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EnquiryExport implements FromView
{
    public $enquiry;

    public function view(Enquiry $enquiry): View
    {
        return view('exports.enquiry', compact('enquiry'));
    }
}