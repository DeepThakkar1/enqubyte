<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'fname', 'lname', 'phone', 'email', 'address',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class);
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
