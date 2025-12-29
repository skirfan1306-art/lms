<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->withDefault(['name' => 'N/A', 'slug' => 'N/A']);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id')
            ->withDefault(['name' => 'N/A', 'slug' => 'N/A']);
    }

    public function syllabus()
    {
        return $this->hasMany(Syllabus::class, 'course_id');
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
    
    public function orders()
    {
        return $this->hasMany(CourseOrder::class, 'course_id');
    }


}
