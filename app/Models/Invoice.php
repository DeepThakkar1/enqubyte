<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\Enquiry;
use App\Models\Visitor;
use App\Models\Customer;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id', 'company_id', 'employee_id', 'store_id', 'enquiry_id', 'due_date', 'invoice_date', 'sub_tot_amt', 'grand_total'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function invoiceitems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function enquiry()
    {
        return $this->hasOne(Enquiry::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'customer_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
