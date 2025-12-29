<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Course;
use App\Models\Syllabus;
use App\Models\Lesson;
use App\Models\CourseOrder;
use App\Models\Review;

class CatalogController extends Controller
{

    public function index(Request $request)
    {
        $search        = $request->query('search');
        $categorySlug  = $request->query('category');
        $subcategorySlug = $request->query('subcategory');
        
        $category = Category::where('status', 1)->withCount('course')->orderBy('name')->get();
        
        $tag = Tag::where('status', 1)->select('tags.*', DB::raw('(SELECT COUNT(*) FROM courses WHERE status = 1 AND courses.tag = tags.name) AS tag_count'))
                ->having('tag_count', '>', 0)->orderBy('name')->get();
    

        $courses = Course::where('status', 1)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('search_keyword', 'like', "%{$search}%");
                });
            })
            ->when($categorySlug, function ($q) use ($categorySlug) {
                $q->whereHas('category', function ($query) use ($categorySlug) {
                    $query->where('slug', $categorySlug);
                });
            })
            ->when($subcategorySlug, function ($q) use ($subcategorySlug) {
                $q->whereHas('subcategory', function ($query) use ($subcategorySlug) {
                    $query->where('slug', $subcategorySlug);
                });
            })
            ->withCount('reviews')->latest()->get();
    
        return view('front.course', compact('courses', 'category', 'tag'));
    }
     
  
    public function single($slug)
    {
        $course = Course::with([
            'syllabus' => function ($q) {
                $q->where('status', 1)->orderBy('sort_order', 'asc');
            }
        ])->where('slug', $slug)->where('status', 1)->withCount('reviews')->firstOrFail();

    
        return view('front.course-single', compact('course'));
    }
    public function single2($slug)
    {
        $course = Course::with([
            'syllabus' => function ($q) {
                $q->where('status', 1)->orderBy('sort_order', 'asc');
            }
        ])->where('slug', $slug)->where('status', 1)->withCount('reviews')->firstOrFail();

    
        return view('front.course-view', compact('course'));
    }
    

public function showLesson($id)
{
    $lesson = Lesson::find($id);

    if (!$lesson) {
        return response()->json([
            'message' => 'Lesson not found.'
        ], 404);
    }

    if (!auth()->check()) {
        return response()->json([
            'message' => 'Please login to continue.'
        ], 401);
    }

    $userId   = auth()->id();
    $courseId = $lesson->course_id;

    $isPurchased = CourseOrder::where('user_id', $userId)
        ->where('course_id', $courseId)
        ->exists();

    if (!$isPurchased) {
        return response()->json([
            'message' => 'You need to purchase this course to access.'
        ], 403);
    }

    if ($lesson->file_type !== 'video') {
        return response()->json([
            'redirect' => route('lesson.view', $lesson->id)
        ]);
    }


    if ($lesson->video_type === 'youtube') {
        $url = 'https://www.youtube.com/embed/' . $lesson->file_name;
    } elseif ($lesson->video_type === 'google') {
        $url = 'https://drive.google.com/file/d/' . $lesson->file_name . '/preview';
    } else {
        return response()->json([
            'message' => 'Unsupported video type.'
        ], 400);
    }

    return response()->json([
        'type' => $lesson->video_type,
        'url'  => $url
    ]);
}




}