<?php

namespace App\Exports;
use App\Models\Incentive;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IncentivesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.incentives', [
            'employees' => auth()->user()->employees
        ]);
    }
}
