<?php

namespace App\Models;
use App\User;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Employee;
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

    public function employees()
    {
        return $this->hasMany(Employee::class)->latest();
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class)->latest();
    }

    public function products()
    {
        return $this->hasMany(Product::class)->latest();
    }
}
