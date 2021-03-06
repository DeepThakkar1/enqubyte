<?php

namespace App\Exports;

use App\Models\Enquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EnquiriesExport implements FromView
{
    public $start_date;
    public $end_date;
    protected $enquiries;


    public function __construct($start_date = null, $end_date = null)
    {
        if (request('start_date') && request('end_date')) {
            $enquiries = auth()->user()->enquiries()->whereBetween('enquiry_date', [request('start_date'), request('end_date')])->get();
        }else{
            $enquiries = auth()->user()->enquiries;
        }
    }

    public function view(): View
    {
        return view('exports.enquiries', [
            'enquiries' => auth()->user()->enquiries
        ]);
    }
}