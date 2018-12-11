<?php

namespace App\Models;
use App\User;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id', 'name', 'address', 'location', 'email', 'phone', 'pincode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function managers()
    {
        return $this->hasMany(Manager::class)->latest();
    }
}
