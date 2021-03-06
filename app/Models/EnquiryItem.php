<?php

namespace App\Models;

use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class EnquiryItem extends Model
{
    protected $fillable = [
        'enquiry_id', 'product_id', 'description','qty', 'price', 'tax', 'product_tot_amt'
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
