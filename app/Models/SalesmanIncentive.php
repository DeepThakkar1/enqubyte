<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class SalesmanIncentive extends Model
{
    protected $fillable = [
        'employee_id', 'enquiry_id', 'invoice_id', 'incentive_amount'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
