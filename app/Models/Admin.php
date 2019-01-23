<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = "admins";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'email',  'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
