<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";
    protected $guarded = [];

    public function syllabus()
    {
        return $this->belongsTo(Syllabus::class, 'syllabus_id')
            ->withDefault(['name' => 'N/A']);
    }
    
    public function mcq()
    {
        return $this->hasMany(Mcq::class, 'lesson_id');
    }

}
