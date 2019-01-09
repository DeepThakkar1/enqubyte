<?php

namespace App\Models;
use App\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Manager extends Model
{

    use Notifiable;

    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'password', 'company_id', 'store_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
