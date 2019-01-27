<?php

namespace App\Models;

use App\Models\Enquiry;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visitor extends Model
{
    use Notifiable;

    protected $fillable = [
        'company_id', 'store_id', 'fname', 'lname', 'phone', 'email', 'address', 'is_customer'
    ];

    protected $appends = ['data_type', 'fullname', 'show_url', 'avatar'];

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

    public function getDataTypeAttribute()
    {
        if($this->is_customer)
            return 'Customers';
        else
            return 'Visitors';
    }

    public function getShowUrlAttribute()
    {
        if($this->is_customer)
            return '/customers/' . $this->id;
        else
            return '/visitors/' . $this->id;

    }

    public function  getAvatarAttribute()
    {
            return \Avatar::create($this->fullname)->setDimension(45, 45)->setFontSize(18)->toSvg();;
    }
}
