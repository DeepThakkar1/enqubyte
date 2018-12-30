<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'company_id', 'name', 'abbreviation', 'rate'
    ];

    public function company()
    {
        return $this->belongsTo(User::class);
    }
}
