<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = [];
    public $timestamps = false;

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
    
    public function course()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
