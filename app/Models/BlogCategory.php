<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Blogcategory extends Model
{
    protected $table = "blog_categories";
    protected $guarded = [];
    public $timestamps = false;
    
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}

