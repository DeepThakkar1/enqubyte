<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class RecordPayment extends Model
{
    protected $fillable = [
    'payment_date','amount','payment_method','payment_account','note'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
