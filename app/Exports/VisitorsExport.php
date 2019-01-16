<?php

namespace App\Exports;

use App\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
class VisitorsExport implements FromCollection, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->visitors;
    }
}
