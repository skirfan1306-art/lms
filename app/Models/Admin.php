<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
