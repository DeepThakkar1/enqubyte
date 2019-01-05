<?php

namespace App\Models;

use App\Models\Enquiry;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'fname', 'lname', 'phone', 'email', 'address', 'is_customer'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'customer_id')->latest();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id')->latest();
    }

    public function getTotalEarningsAttribute()
    {
        return $this->invoices()->sum('grand_total');
    }

    public function getTotalRemainingAttribute()
    {
        return $this->invoices()->sum('remaining_amount');
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
