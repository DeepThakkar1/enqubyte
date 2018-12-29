<?php

namespace App\Models;

use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_order_id', 'product_id', 'qty', 'price', 'tax', 'product_tot_amt'
    ];

    public function purchase()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }
}
