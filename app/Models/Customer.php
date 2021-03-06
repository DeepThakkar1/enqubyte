<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\Enquiry;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;

    protected $fillable = [
        'company_id', 'visitor_id', 'store_id', 'fname', 'lname', 'phone', 'email', 'address', 'is_customer'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class)->latest();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
    }
}
