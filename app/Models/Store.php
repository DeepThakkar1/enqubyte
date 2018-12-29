<?php

namespace App\Models;
use App\User;
use App\Models\Stock;
use App\Models\Enquiry;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id', 'name', 'address', 'location', 'email', 'phone', 'pincode',
    ];

    public function company()
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

    public function stocks()
    {
        return $this->hasMany(Stock::class)->latest();
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class)->latest();
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseOrder::class)->latest();
    }
}
