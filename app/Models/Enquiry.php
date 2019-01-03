<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EnquiryItem;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'customer_id', 'company_id', 'employee_id', 'store_id', 'followup_date', 'date','enquiry_date', 'sub_tot_amt', 'grand_total', 'status', 'discount_type', 'discount'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function enquiryitems()
    {
        return $this->hasMany(EnquiryItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Visitor::class, 'customer_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
