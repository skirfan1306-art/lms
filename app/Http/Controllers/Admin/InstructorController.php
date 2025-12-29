<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instructor;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Mail\InstructorMailController;

class InstructorController extends Controller
{
    public function index()
    {
        return view('admin.instructor.create');
    }

    public function show()
    {
        $instructors = Instructor::all();

        return view('admin.instructor.index', compact('instructors'));
    }
    
    public function view($id)
    {
        $instructor = Instructor::findOrFail($id);
        $courses = Course::withCount('syllabus')->where('instructor_id', $instructor->id)->latest()->get();

        return view('admin.instructor.view', compact('instructor', 'courses'));
    }
    
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);

        return view('admin.instructor.edit', compact('instructor'));
    }



    public function create(Request $req)
    {
        $req->validate([
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp',
            'name'         => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email'        => 'required|email|unique:instructors,email',
            'number'       => 'required|numeric',
            'designation'  => 'required|string',
            'description'  => 'required|string',
        ]);
    
        $instructor = new Instructor();
    
        $pass = $req->password ?? Str::random(8);
    
        $instructor->fill($req->only([
            'name',
            'email',
            'number',
            'designation',
            'description'
        ]));
    
        $instructor->password = Hash::make($pass);
    
        if ($req->hasFile('image')) {
            $imageName = time() . 'I' . uniqid() . '.' . $req->image->extension();
            $req->image->move(
                base_path('assets/front/images/instructor/'),
                $imageName
            );
            $instructor->image = $imageName;
        }
    
        $instructor->verified = 1;
    
        if ($instructor->save()) {
            (new InstructorMailController)->wellcomeMail($instructor, $pass);
            return back()->with('success', 'Instructor Added Successfully!');
        }
    
        return back()->with('error', 'Instructor not added!')->withInput();
    }

    
    public function update(Request $req)
    {
        $req->validate([
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'name'         => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email'        => 'required|email|unique:instructors,email,' . $req->id,
            'number'       => 'required|numeric',
            'designation'  => 'required|string',
            'description'  => 'required|string',
        ]);
    
        $instructor = Instructor::findOrFail($req->id);
        $instructor->fill($req->only(['name', 'email', 'number', 'designation', 'description','facebook', 'linkedin', 'twitter', 'instagram']));

        if ($req->hasFile('image')) {
            $oldThumbPath = base_path('assets/front/images/instructor/' . $instructor->image);
            if ($instructor->image && file_exists($oldThumbPath)) {
                unlink($oldThumbPath);
            }
        
            $imageName = time() . 'I' . uniqid() . '.' . $req->image->extension();
            $req->image->move(base_path('assets/front/images/instructor/'), $imageName);
        
            $instructor->image = $imageName;
        }
    
        $saved = $instructor->save();
    
        if ($saved) {
            return back()->with('success', 'Instructor Updated Successfully!');
        } else {
            return back()->with('error', 'Instructor not Updated!')->withInput();
        }
    }
    
    public function passupdate(Request $req)
    {
        $req->validate([
            'password'      => 'required|min:8',
            'confirm_pass'  => 'required|same:password',
        ]);
    
        $instructor = Instructor::findOrFail($req->id);
            
        $instructor->password = Hash::make($req->password);
    
        if ($instructor->save()) {
            return back()->with('success', 'Instructor Password Updated Successfully!');
        }
    
        return back()->with('error', 'Instructor Password not Updated!')->withInput();
    }
    
    public function status(Request $req)
    {
        $instructor = Instructor::findOrFail($req->id);
        $instructor->status = $instructor->status == 1 ? 0 : 1;

        if ($instructor->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    
    public function delete(Request $req)
    {
        $instructor = Instructor::findOrFail($req->id);
        
        if (!empty($instructor->image) && file_exists(base_path('assets/front/images/instructor/') . $instructor->image)) {
            unlink(base_path('assets/front/images/instructor/') . $instructor->image);
        }
        
        $deleted = $instructor->delete();

        if ($deleted) {
            return back()->with('success', 'Instructor Deleted Successfully!');
        } else {
            return back()->with('error', 'Instructor not Deleted!');
        }
    }




}