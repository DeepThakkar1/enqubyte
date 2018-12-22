<?php

namespace App\Models;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'fname', 'lname', 'phone', 'email', 'address',
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
        return $this->hasMany(Enquiry::class)->latest();
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
