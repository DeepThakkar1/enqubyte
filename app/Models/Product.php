<?php

namespace App\Models;
use App\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'name', 'description', 'selling_price', 'stock', 'cost_price', 'tax', 'hsn_code', 'product_code',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class);
    }
}
