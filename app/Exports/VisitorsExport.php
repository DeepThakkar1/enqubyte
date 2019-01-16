<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VisitorsExport implements FromView
{
    public function view(): View
    {
        return view('exports.visitors', [
            'visitors' => auth()->user()->visitors
        ]);
    }
}