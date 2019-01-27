<?php

namespace App\Models;

use App\User;
use App\Models\Store;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $fillable = [
        'company_id', 'store_id', 'name', 'phone', 'email', 'contact_person', 'address'
    ];

    protected $appends = ['data_type', 'fullname', 'show_url', 'avatar'];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseOrder::class)->latest();
    }

    public function getTotalPaymentsAttribute()
    {
        return $this->purchases()->sum('grand_total');
    }

    public function getDataTypeAttribute()
    {
        return 'Vendors';
    }

    public function getFullnameAttribute()
    {
        return $this->name;
    }

    public function getShowUrlAttribute()
    {
        return '/vendors/' . $this->id;
    }

    public function  getAvatarAttribute()
    {
            return \Avatar::create($this->fullname)->setDimension(45, 45)->setFontSize(18)->toSvg();
    }
}
