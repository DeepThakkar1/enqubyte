<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class IncentiveTransaction extends Model
{
    protected $fillable = [
        'employee_id', 'amount', 'transaction_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
