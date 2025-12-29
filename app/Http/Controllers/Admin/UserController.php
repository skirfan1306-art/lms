<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user.create', compact('category'));
    }

    public function show()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function create(Request $req)
    {
        $req->validate([
            'image'       => 'required|image',
            'alt'         => 'required|string|max:100',
            'title'       => 'required|string|max:255|unique:blogs,title',
            'excerpt'     => 'required|string|max:180',
            'description' => 'required|string',
            'category_id'       => 'required',
            'status'      => 'nullable|in:0,1',
            'created_at'  => 'required',
        ]);

        $blog = new Blog();
        $blog->fill($req->only(['alt', 'title', 'excerpt', 'description', 'status', 'category_id', 'created_at']));
        $blog->slug = Str::slug($req->title);

        if ($req->hasFile('image')) {
            if ($req->has('make_webp')) {
                $this->uploadFileWebp($req, 'image', $blog);
            } else {
                $this->uploadFileNormally($req, 'image', $blog);
            }
        }

        $saved = $blog->save();

        if ($saved) {
            return back()->with('success', 'Blog Created Successfully!');
        } else {
            return back()->with('error', 'Blog not Created!')->withInput();
        }
    }
    
    public function update(Request $req)
    {
        $req->validate([
            'id'          => 'required|exists:blogs,id',
            'image'       => 'nullable|image',
            'alt'         => 'required|string|max:100',
            'title'       => 'required|string|max:255|unique:blogs,title,' . $req->id,
            'excerpt'     => 'required|string|max:180',
            'description' => 'required|string',
            'status'      => 'nullable|in:0,1',
            'created_at'  => 'required',
        ]);
    
        $blog = Blog::findOrFail($req->id);
        $blog->fill($req->only(['alt', 'title', 'excerpt', 'description', 'status', 'category_id', 'created_at']));
        $blog->slug = Str::slug($req->title);

        if ($req->hasFile('image')) {
            if ($req->has('make_webp')) {
                $this->uploadFileWebp($req, 'image', $blog);
            } else {
                $this->uploadFileNormally($req, 'image', $blog);
            }
        }
    
        $saved = $blog->save();
    
        if ($saved) {
            return back()->with('success', 'Blog Updated Successfully!');
        } else {
            return back()->with('error', 'Blog not Updated!')->withInput();
        }
    }
    
    public function status(Request $req)
    {
        $user = User::findOrFail($req->id);
        $user->status = $user->status == 1 ? 0 : 1;

        if ($user->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    
    public function delete(Request $req)
    {
        $user = User::findOrFail($req->id);
        
        if (!empty($user->image) && file_exists(base_path('assets/front/images/users/') . $user->image)) {
            unlink(base_path('assets/front/images/users/') . $user->image);
        }
        
        $deleted = $user->delete();

        if ($deleted) {
            return back()->with('success', 'User Deleted Successfully!');
        } else {
            return back()->with('error', 'User not Deleted!');
        }
    }




}