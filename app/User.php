<?php

namespace App;
use App\Models\Tax;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Customer;
use App\Models\Incentive;
use App\Models\Employee;
use App\Models\PurchaseOrder;
use App\Models\ReportFrequency;
use Rennokki\Plans\Traits\HasPlans;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasPlans;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'company_email', 'company_phone', 'company_name', 'company_username', 'company_type', 'estimated_monthly_sales', 'number_of_employees', 'password', 'mode', 'demo', 'email_verified_at', 'company_address', 'footer_line', 'company_logo', 'taxmode','invoicetaxes', 'plan'
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

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id')->latest();
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'company_id')->latest();
    }

    public function customers()
    {
        return $this->hasMany(Visitor::class, 'company_id')->latest();
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'company_id')->latest();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id')->latest();
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'company_id')->latest();
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'company_id')->latest();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'company_id')->latest();
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseOrder::class, 'company_id')->latest();
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class, 'company_id')->latest();
    }

    public function incentives()
    {
        return $this->hasMany(Incentive::class, 'company_id')->latest();
    }

    public function reportfrequency()
    {
        return $this->hasOne(ReportFrequency::class, 'company_id');
    }

    public function getMonthlyRevenueDataAttribute()
    {
       return auth()->user()->invoices()->selectRaw('MONTH(invoice_date) as month, SUM(grand_total) as revenue')->groupBy(\DB::raw('MONTH(invoice_date)'))->pluck('revenue', 'month');
    }

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function getNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
