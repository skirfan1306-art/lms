<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Course;
use App\Models\Syllabus;
use App\Models\Lesson;
use App\Models\Mcq;
use App\Models\Review;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;


class CourseController extends Controller
{
    public function index()
    {
        $subcategory = Subcategory::where('status', 1)->orderBy('name')->get();
        $category = Category::where('status', 1)->orderBy('name')->get();
        $tags = Tag::where('status', 1)->orderBy('name')->get();
        $instructor = Instructor::where('status', 1)->orderBy('name')->get();
        
        if (Route::is('admin.course*')) {
            return view('admin.course.add', compact('category', 'subcategory', 'tags', 'instructor'));
        }
    
        if (Route::is('instructor.course*')) {
            return view('instructor.course.add', compact('category', 'subcategory', 'tags'));
        }
    }

    public function show($slug = null)
    {
        if ($slug) {
            $category = Category::where('slug', $slug)->first();
            $name = $category->name;
            $courses = Course::withCount('syllabus')->where('category_id', $category->id)->latest()->get();
    
        } else {
            $courses = Course::withCount('syllabus')->latest()->get();
            $name = 'All';
        }
        
        $user = Auth::user();
        
        if (Route::is('admin.courses')) {
            return view('admin.course.courses', compact('courses', 'name'));
        }
    
        if (Route::is('instructor.courses')) {
            $courses = $courses->where('instructor_id', $user->id);
            return view('instructor.course.courses', compact('courses', 'name'));
        }
    }


    public function create(Request $req)
    {
        $req->validate([
            'name'        => 'required|unique:products,name',
            'instructor_id'  => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id'    => 'required|exists:subcategories,id',
            'description' => 'required',
            'excerpt' => 'required',
            'price'       => 'required',
            'old_price'   => 'required_unless:price,free|numeric|nullable',
            'sale_price'  => 'required_unless:price,free|numeric|nullable',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'search'      => 'nullable|string',
            'status'      => 'required|boolean',
        ]);

        $slug = Str::slug($req->name);

        // ---------- Thumbnail Upload ----------

        $thumbnail = null;
        if ($req->hasFile('thumbnail')) {
        
            $imageName = time() . 'T' . uniqid() . '.' . $req->thumbnail->extension();
            $req->thumbnail->move(base_path('assets/front/images/course/'), $imageName);
        
            $thumbnail = $imageName;
        }
        
        if($req->price == 'free'){
            $oldP = null;
            $saleP = null;
        } else {
            $oldP = $req->old_price;
            $saleP = $req->sale_price;
        }

        // ---------- Save Product ----------
        $product = Course::create([
            'name'           => $req->name,
            'instructor_id' => $req->instructor_id,
            'slug'           => $slug,
            'category_id'    => $req->category_id,
            'subcategory_id'       => $req->subcategory_id,
            'price'      => $req->price,
            'old_price'      => $oldP,
            'sale_price'     => $saleP,
            'description'    => $req->description,
            'excerpt'    => $req->excerpt,
            'benefit'    => $req->benefit,
            'image'      => $thumbnail,
            'tag'            => $req->tag,
            'level' => $req->level,
            'duration' => $req->duration,
            'language' => $req->language,
            'search_keyword' => $req->search,
            'status'         => $req->status,
        ]);

        return back()->with($product ? 'success' : 'error', $product ? 'Course created successfully!' : 'Failed to create the course!');
    }
    
    public function edit($id)
    {
        $subcategory = Subcategory::where('status', 1)->orderBy('name')->get();
        $category = Category::where('status', 1)->orderBy('name')->get();
        $tags = Tag::where('status', 1)->orderBy('name')->get();
        $instructor = Instructor::where('status', 1)->orderBy('name')->get();
        
        if (Route::is('admin.course*')) {
            $edit = Course::findOrFail($id);
            return view('admin.course.edit', compact('edit', 'category', 'subcategory', 'tags', 'instructor'));
        }
    
        if (Route::is('instructor.course*')) {
            $user = Auth::user();
            $edit = Course::where('id', $id)->where('instructor_id', $user->id)->firstOrFail();
            return view('instructor.course.edit', compact('edit', 'category', 'subcategory', 'tags'));
        }
    }
    
    public function update(Request $req, $id)
    {
        $product = Course::findOrFail($id);
    
        $req->validate([
            'name'        => 'required|unique:products,name,' . $product->id,
            'instructor_id'  => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id'    => 'required|exists:subcategories,id',
            'description' => 'required',
            'excerpt' => 'required',
            'price'       => 'required',
            'old_price'   => 'required_unless:price,free|numeric|nullable',
            'sale_price'  => 'required_unless:price,free|numeric|nullable',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'value.*'        => 'nullable|string',
            'status'      => 'required|boolean',
        ]);
    
        $slug = Str::slug($req->name);
    
        // ---------- Handle Thumbnail ----------
        $thumbnail = $product->image;
        
        if ($req->hasFile('thumbnail')) {
        
            $oldThumbPath = base_path('assets/front/images/course/' . $product->thumbnail);
            if ($product->thumbnail && file_exists($oldThumbPath)) {
                unlink($oldThumbPath);
            }
        
            $imageName = time() . 'T' . uniqid() . '.' . $req->thumbnail->extension();
            $req->thumbnail->move(base_path('assets/front/images/course/'), $imageName);
        
            $thumbnail = $imageName;
        }
        
        if($req->price == 'free'){
            $oldP = null;
            $saleP = null;
        } else {
            $oldP = $req->old_price;
            $saleP = $req->sale_price;
        }
    
        // ---------- Update Product ----------
        $updated = $product->update([
            'name'           => $req->name,
            'instructor_id' => $req->instructor_id,
            'slug'           => $slug,
            'category_id'    => $req->category_id,
            'subcategory_id'       => $req->subcategory_id,
            'price'      => $req->price,
            'old_price'      => $oldP,
            'sale_price'     => $saleP,
            'description'    => $req->description,
            'excerpt'    => $req->excerpt,
            'benefit'    => $req->benefit,
            'image'      => $thumbnail,
            'tag'            => $req->tag,
            'level' => $req->level,
            'duration' => $req->duration,
            'language' => $req->language,
            'search_keyword' => $req->search,
            'status'         => $req->status,
        ]);
    
        return back()->with($updated ? 'success' : 'error', $updated ? 'Course updated successfully!' : 'Failed to update course!');
    }
        
    public function view($id)
    {
        $view = Course::findOrFail($id);
    
        $syllabus = Syllabus::with('lesson')->where('course_id', $id)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        
        $reviews = Review::where('course_id', $id)->get();
        $averageRating = Review::where('course_id', $id)->avg('rating');
        $totalReviews = Review::where('course_id', $id)->count();
        
        $ratingCounts = [
            5 => Review::where('course_id', $id)->where('rating', 5)->count(),
            4 => Review::where('course_id', $id)->where('rating', 4)->count(),
            3 => Review::where('course_id', $id)->where('rating', 3)->count(),
            2 => Review::where('course_id', $id)->where('rating', 2)->count(),
            1 => Review::where('course_id', $id)->where('rating', 1)->count(),
        ];
        
        if (Route::is('admin.course*')) {
            return view('admin.course.view', compact('view','syllabus','reviews','averageRating','totalReviews','ratingCounts'));
        }
    
        if (Route::is('instructor.course*')) {
            return view('instructor.course.view', compact('view','syllabus','reviews','averageRating','totalReviews','ratingCounts'));
        }
    

    }


    public function delete(Request $req)
    {
        $course = Course::findOrFail($req->id);
        
        if (!empty($course->image) && file_exists(base_path('assets/front/images/course/') . $course->image)) {
            unlink(base_path('assets/front/images/course/') . $course->image);
        }
        
        $deleted = $course->delete();

        if ($deleted) {
            return back()->with('success', 'Course Deleted Successfully!');
        } else {
            return back()->with('error', 'Course not Deleted!');
        }
    }
    
    
    
    ///// --------- *** Syllabus *** ---------- /////
    public function syllabus($id)
    {
        
        if (Route::is('admin.course*')) {
            $course = Course::where('id', $id)->first();
            $syllabus = Syllabus::withCount('lesson')->where('course_id', $id)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
            
            return view('admin.course.syllabus', compact('course', 'syllabus'));
        }
    
        if (Route::is('instructor.course*')) {
            
            $user = Auth::user();
            $course = Course::where('id', $id)->where('instructor_id', $user->id)->firstOrFail();
            $syllabus = Syllabus::withCount('lesson')->where('course_id', $id)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
            
            return view('instructor.course.syllabus', compact('course', 'syllabus'));
        }
        
    }

    
    public function syllabusAdd($id)
    {
        
        if (Route::is('admin.course*')) {
            $course = Course::where('id', $id)->first();

            return view('admin.course.syllabus-add', compact('course'));        
            
        }
    
        if (Route::is('instructor.course*')) {
            
            $user = Auth::user();
            $course = Course::where('id', $id)->where('instructor_id', $user->id)->firstOrFail();

            return view('instructor.course.syllabus-add', compact('course'));        
            
        }
    }
    
    public function syllabusCreate(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('syllabus')->where(function ($query) use ($req) {
                    return $query->where('course_id', $req->course_id);
                }),
            ],
            'course_id' => 'required',
        ],[
            'name.required' => 'Please enter a syllabus name.',
            'name.unique'   => 'This syllabus already exists for this course.',
            'course_id.required' => 'Course not found!',
        ]);

        $slug = Str::slug($req->name);
        $maxOrder = Syllabus::where('course_id', $req->course_id)->max('sort_order') ?? 0;
        
        $syllabus = Syllabus::create([
            'name'           => $req->name,
            'slug'           => $slug,
            'course_id'    => $req->course_id,
            'status'         => $req->status,
            'sort_order' => $maxOrder + 1,
        ]);

        return back()->with($syllabus ? 'success' : 'error', $syllabus ? 'Syllabus created successfully!' : 'Failed to create the syllabus!');
    }
    
    public function syllabusEdit($id)
    {
        $edit = Syllabus::findOrFail($id);
        
        if (Route::is('admin.course*')) {
            $course = Course::findOrFail($edit->course_id);

            return view('admin.course.syllabus-edit', compact('edit', 'course'));       
            
        }
    
        if (Route::is('instructor.course*')) {
            
            $user = Auth::user();
            $course = Course::where('id', $edit->course_id)->where('instructor_id', $user->id)->firstOrFail();

            return view('instructor.course.syllabus-edit', compact('edit', 'course'));        
            
        }
    }
    
    public function syllabusUpdate(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('syllabus')
                    ->where(function ($query) use ($req) {
                        return $query->where('course_id', $req->course_id);
                    })
                    ->ignore($req->id),
            ],
        ], [
            'name.required'      => 'Please enter a syllabus name.',
            'name.unique'        => 'This syllabus already exists for this course.',
        ]);
    
        $slug = Str::slug($req->name);
    
        $syllabus = Syllabus::findOrFail($req->id);
    
        $syllabus->update([
            'name'   => $req->name,
            'slug'   => $slug,
            'status' => $req->status,
        ]);
    
        return back()->with('success', 'Syllabus updated successfully!');
    }
    
    public function syllabusDelete(Request $req)
    {
        $syllabus = Syllabus::findOrFail($req->id);
        
        $deleted = $syllabus->delete();

        if ($deleted) {
            return back()->with('success', 'Syllabus Deleted Successfully!');
        } else {
            return back()->with('error', 'Syllabus not Deleted!');
        }
    }
    
    public function syllabusSort(Request $request)
    {
        $order = $request->order;
    
        if (!is_array($order)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid data'], 422);
        }
    
        foreach ($order as $index => $id) {
            Syllabus::where('id', $id)->update([
                'sort_order' => $index + 1
            ]);
        }
    
        return response()->json(['status' => 'success']);
    }
    
    
    ///// --------- *** Lesson *** ---------- /////
    public function lesson($id)
    {
        $syllabus = Syllabus::where('id', $id)->first();
        $course = Course::where('id', $syllabus->course_id)->first();
        $lesson = Lesson::where('syllabus_id', $syllabus->id)->withCount('mcq')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.course.lesson', compact('course', 'syllabus', 'lesson'));
    }
    
    public function lessonAdd($id)
    {
        $syllabus = Syllabus::where('id', $id)->first();
        $course = Course::where('id', $syllabus->course_id)->first();
        return view('admin.course.lesson-add', compact('course', 'syllabus'));
    }
    



public function lessonCreate(Request $req)
{
    $req->validate([
        'name' => 'required|unique:lessons,name,NULL,id,syllabus_id,' . $req->syllabus_id,
        'course_id' => 'required',
        'syllabus_id' => 'required',
        'selected_type' => 'required'
    ],[
        'name.required' => 'Please enter a lesson name.',
        'name.unique'   => 'This lesson already exists for this syllabus.',
        'course_id.required' => 'Course not found!',
        'syllabus_id.required' => 'Syllabus not found!',
        'selected_type.required' => 'Please select Video or File or MCQ',
    ]);

    if ($req->selected_type == "video") {
        $req->validate([
            'video_link' => 'required'
        ],[
            'video_link.required' => 'Please enter video link!',
        ]);
    }

    if ($req->selected_type == "file") {
        $req->validate([
            'lesson_file' => 'required'
        ],[
            'lesson_file.required' => 'Please upload a file!',
        ]);
    }

    if ($req->selected_type == "mcq") {
        $req->validate([
            'question'  => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'answer'   => 'required|in:A,B,C,D',
            'solution' => 'nullable|string'
        ],[
            'answer.required' => 'Please select the correct answer!',
        ]);
    }

    DB::beginTransaction();

    try {

        $slug = Str::slug($req->name);
        $maxOrder = Lesson::where('syllabus_id', $req->syllabus_id)->max('sort_order') ?? 0;

        $fileType = $req->selected_type;
        $videoType = null;
        $fileName = null;

        if ($req->selected_type == "video") {
            $fileName = $req->video_link;
            $videoType = $req->video_type;
        }

        if ($req->selected_type == "file") {
            $file = $req->file('lesson_file');
            $newName = time() . Str::random(4) . "." . $file->getClientOriginalExtension();
            $file->move(base_path('assets/media'), $newName);
            $fileName = $newName;
        }

        $lesson = Lesson::create([
            'course_id'    => $req->course_id,
            'syllabus_id'  => $req->syllabus_id,
            'name'         => $req->name,
            'slug'         => $slug,
            'file_type'    => $fileType,
            'video_type' => $videoType,
            'file_name'    => $fileName,
            'status'       => $req->status,
            'sort_order'   => $maxOrder + 1,
        ]);

        if ($req->selected_type == "mcq") {
            Mcq::create([
                'lesson_id' => $lesson->id,
                'question'  => $req->question,
                'option_a'  => $req->option_a,
                'option_b'  => $req->option_b,
                'option_c'  => $req->option_c,
                'option_d'  => $req->option_d,
                'answer'    => $req->answer,
                'solution'  => $req->solution,
            ]);
        }

        DB::commit();

        return redirect()->route('admin.syllabus.lesson.edit', $lesson->id)
                ->with('success', 'Lesson created successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', 'Something went wrong! Lesson not created.')->withInput();
    }
}

    
    public function lessonEdit($id)
    {
        $edit = Lesson::where('id', $id)->first();
        $syllabus = Syllabus::where('id', $edit->syllabus_id)->first();
        $course = Course::where('id', $edit->course_id)->first();
        
        $mcqs = null;
        
        if($edit->file_type == 'mcq'){
            $mcqs = Mcq::where('lesson_id', $edit->id)->get();
        }
        
        return view('admin.course.lesson-edit', compact('edit', 'course', 'syllabus', 'mcqs'));
    }

    public function lessonUpdate(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('lessons')
                    ->where(function ($query) use ($req) {
                        return $query->where('syllabus_id', $req->syllabus_id);
                    })
                    ->ignore($req->id),
            ],
            'selected_type' => 'required'
        ],[
            'name.required' => 'Please enter a lesson name.',
            'name.unique'   => 'This lesson already exists for this syllabus.',
            'selected_type.required' => 'Please select Video or File or MCQ',
        ]);
    
        $lesson = Lesson::findOrFail($req->id);
    
        $slug = Str::slug($req->name);
    

        $videoType = $lesson->video_type ?? '';
        $fileType = $lesson->file_type ?? '';
        $fileName = $lesson->file_name ?? '';
    
        if ($req->selected_type == "video") {
    
            $req->validate([
                'video_link' => 'required'
            ],[
                'video_link.required' => 'Please enter video link!',
            ]);
    
            $fileType = "video";
            $videoType = $req->video_type;
            $fileName = $req->video_link;
    
            if ($lesson->file_type == "file" && $lesson->file_name) {
                $oldPath = base_path("assets/media/" . $lesson->file_name);
                if (file_exists($oldPath)) unlink($oldPath);
            }
        }
    
        if ($req->selected_type == "file") {
    
            if ($req->hasFile('lesson_file')) {
    
                $req->validate([
                    'lesson_file' => 'required|file|mimes:pdf,doc,docx,jpg,png'
                ]);
    
                if ($lesson->file_type == "file" && $lesson->file_name) {
                    $oldPath = base_path("assets/media/" . $lesson->file_name);
                    if (file_exists($oldPath)) unlink($oldPath);
                }
    
                $file = $req->file('lesson_file');
                $newName = time() . Str::random(4) . "." . $file->getClientOriginalExtension();
                $file->move(base_path('assets/media'), $newName);
    
                $fileType = "file";
                $fileName = $newName;
            }
        }
    
        $lesson->update([
            'name' => $req->name,
            'slug' => $slug,
            'status' => $req->status,
            'file_type' => $fileType,
            'video_type' => $videoType,
            'file_name' => $fileName,
        ]);
    
        return back()->with('success', 'Lesson updated successfully!');
    }
    
    public function lessonDelete(Request $req)
    {
        $lesson = Lesson::findOrFail($req->id);
        
        $deleted = $lesson->delete();

        if ($deleted) {
            return back()->with('success', 'Lesson Deleted Successfully!');
        } else {
            return back()->with('error', 'Lesson not Deleted!');
        }
    }
    
    public function lessonSort(Request $request)
    {
        $order = $request->order;
    
        if (!is_array($order)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid data'], 422);
        }
    
        foreach ($order as $index => $id) {
            Lesson::where('id', $id)->update([
                'sort_order' => $index + 1
            ]);
        }
    
        return response()->json(['status' => 'success']);
    }
    

    public function mcqStore(Request $request)
    {
        $validated = $request->validate([
            'question'      => 'required|string|max:255',
            'option_a'     => 'required|string|max:255',
            'option_b'     => 'required|string|max:255',
            'option_c'     => 'required|string|max:255',
            'option_d'     => 'required|string|max:255',
            'answer'      => 'required|in:A,B,C,D',
            'solution' => 'nullable|string'
        ],[
            'answer.required' => 'Please select the correct answer!',
        ]);

        Mcq::create([
            'lesson_id' => $request->lesson_id,
            'question'  => $request->question,
            'option_a'  => $request->option_a,
            'option_b'  => $request->option_b,
            'option_c'  => $request->option_c,
            'option_d'  => $request->option_d,
            'answer'    => $request->answer,
            'solution'  => $request->solution,
        ]);

        return response()->json([
            'status' => 200,
            'msg'    => 'MCQ Added Successfully!'
        ]);
    }
    
    
    public function mcqEdit($id)
    {
        $edit = Mcq::where('id', $id)->first();

        return view('admin.course.edit-mcq', compact('edit'));
    }
    
    
    public function mcqUpdate(Request $request)
    {
        $request->validate([
            'id'          => 'required|exists:mcqs,id',
            'question'    => 'required|string|max:255',
            'option_a'    => 'required|string|max:255',
            'option_b'    => 'required|string|max:255',
            'option_c'    => 'required|string|max:255',
            'option_d'    => 'required|string|max:255',
            'answer'      => 'required|in:A,B,C,D',
            'solution'    => 'nullable|string'
        ]);
    
        $mcq = Mcq::find($request->id);
        $mcq->update($request->only([
            'question',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'answer',
            'solution'
        ]));
    
        return back()->with('success', 'MCQ Updated Successfully!');
    }
    
    public function mcqDelete(Request $req)
    {
        $mcq = Mcq::findOrFail($req->id);
        
        $deleted = $mcq->delete();

        if ($deleted) {
            return back()->with('success', 'MCQ Deleted Successfully!');
        } else {
            return back()->with('error', 'MCQ not Deleted!');
        }
    }


    
}