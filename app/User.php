<?php

namespace App;
use App\Models\Store;
use App\Models\Manager;
use App\Models\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'company_name', 'company_username', 'company_type', 'estimated_monthly_sales', 'number_of_employees', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function stores()
    {
        return $this->hasMany(Store::class)->latest();
    }

    public function managers()
    {
        return $this->hasMany(Manager::class, 'company_id')->latest();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id')->latest();
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
