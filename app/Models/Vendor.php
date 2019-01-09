<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $fillable = [
        'company_id', 'store_id', 'name', 'phone', 'email', 'contact_person', 'address'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseOrder::class)->latest();
    }

    public function getTotalPaymentsAttribute()
    {
        return $this->purchases()->sum('grand_total');
    }
}
