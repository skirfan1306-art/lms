<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = "syllabus";
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')
            ->withDefault(['name' => 'N/A', 'slug' => '']);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'syllabus_id', 'id')->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

}
