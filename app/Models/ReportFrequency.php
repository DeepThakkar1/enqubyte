<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class ReportFrequency extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'weekly', 'monthly', 'quarterly', 'sixmonth', 'yearly'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
