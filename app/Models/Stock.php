<?php

namespace App\Models;
use App\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'product_id', 'qty'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
