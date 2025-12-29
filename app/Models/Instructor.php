<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model;

class Instructor extends Authenticatable
{
    protected $table = "instructors";
    protected $guarded = [];
    // public $timestamps = false;

    public function course()
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }
}
