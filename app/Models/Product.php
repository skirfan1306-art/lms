<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = [];
    // public $timestamps = false;
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault(['name' => 'N/A','slug' => 'N/A',]);
    }
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id')->withDefault(['name' => 'N/A','slug' => 'N/A',]);
    }

}