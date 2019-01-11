<?php

namespace App\Models;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderRecordPayment extends Model
{
    protected $fillable = [
        'payment_date','amount','payment_method','payment_account','note'
    ];

    public function purchase()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
