<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    protected $table = "course_orders";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
