<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\BlogComment;

class Blog extends Model
{
    protected $table = "blogs";
    protected $guarded = [];
    public $timestamps = false;
    
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
    
    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }
}
