<?php

namespace App\Models;
use App\User;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Enquiry;
use App\Models\EnquiryItem;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id', 'store_id', 'name', 'description', 'selling_price', 'stock', 'cost_price', 'tax', 'hsn_code', 'product_code', 'has_stock'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
    }

    /*public function enquiries()
    {
        return $this->hasManyThrough(Enquiry::class, EnquiryItem::class, 'product_id', 'id', 'enquiry_id', 'product_id');
    }
*/
    public function enquiryitems()
    {
        return $this->hasMany(EnquiryItem::class);
    }

    public function getProductEnquiryAttribute()
    {
        return $this->enquiryitems()->where('product_id', $this->id);
    }

}
