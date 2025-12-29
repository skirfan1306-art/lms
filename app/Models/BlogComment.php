<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class BlogComment extends Model
{
    protected $table = "blog_comment";
    protected $guarded = [];
    public $timestamps = false;
    
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
