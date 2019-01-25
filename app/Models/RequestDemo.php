<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RequestDemo extends Model
{
    use Notifiable;

    protected $fillable=['fname','lname','email'];
}
