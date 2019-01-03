<?php

namespace App\Models;

use App\Models\Enquiry;
use App\Models\Incentive;
use App\Models\SalesmanIncentive;
use App\Models\IncentiveTransaction;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'photo', 'verification_doc', 'password', 'company_id', 'store_id', 'incentive_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
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

    public function incentive()
    {
        return $this->belongsTo(Incentive::class);
    }

    public function salesmanincentives()
    {
        return $this->hasMany(SalesmanIncentive::class)->latest();
    }



    public function incentivetransactions()
    {
        return $this->hasMany(IncentiveTransaction::class);
    }



    public function getIncentiveAmountAttribute()
    {
        return $this->salesmanincentives()->sum('incentive_amount');
    }
}
