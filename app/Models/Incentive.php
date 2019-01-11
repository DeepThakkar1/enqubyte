<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $fillable = [
        'name', 'type', 'rate', 'minimum_invoice_amt', 'company_id'
    ];

}
