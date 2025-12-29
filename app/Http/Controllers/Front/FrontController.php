<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\ContactForm;
use App\Models\Course;


class FrontController extends Controller
{

    public function home(){
        $category = Category::where('status', 1)->withCount('course')->having('course_count', '>', 0)->orderBy('name')->get();
        
        $courses = Course::where('status', 1)->get(); 
                          
        $blog = Blog::where('status', '1')->get();
        return view('front.index', compact('category','courses', 'blog'));
    }

 

}