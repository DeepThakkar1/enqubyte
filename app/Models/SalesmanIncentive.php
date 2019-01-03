<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesmanIncentive extends Model
{
    protected $fillable = [
        'employee_id', 'enquiry_id', 'invoice_id', 'incentive_amount'
    ];
}
