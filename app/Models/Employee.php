<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'photo', 'verification_doc', 'password', 'company_id', 'store_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users()
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
}
