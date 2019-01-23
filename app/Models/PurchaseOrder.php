<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\PurchaseItem;
use App\Models\PusrchaseOrderRecordPayment;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'sr_no', 'company_id', 'store_id', 'order_id', 'vendor_id', 'due_date', 'purchase_date', 'sub_tot_amt', 'grand_total', 'order_scan_copy', 'remaining_amount', 'status', 'discount', 'discount_type', 'taxes'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function purchaseitems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function payments()
    {
        return $this->hasMany(PurchaseOrderRecordPayment::class);
    }

    public function getTaxesAttribute()
    {
        return json_decode($this->attributes['taxes']);
    }
}
