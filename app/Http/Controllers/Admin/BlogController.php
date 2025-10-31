<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.create');
    }

    public function show()
    {
        $blog = Blog::orderBy('id', 'desc')->get();
        return view('admin.blog.index', compact('blog'));
    }
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function create(Request $req)
    {
        $req->validate([
            'image'       => 'required|image',
            'alt'         => 'required|string|max:100',
            'title'       => 'required|string|max:255|unique:blogs,title',
            'excerpt'     => 'required|string|max:180',
            'description' => 'required|string',
            'status'      => 'nullable|in:0,1',
            'created_at'  => 'required',
        ]);

        $blog = new Blog();
        $blog->fill($req->only(['alt', 'title', 'excerpt', 'description', 'status', 'created_at']));
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
    $blog->fill($req->only(['alt', 'title', 'excerpt', 'description', 'status', 'created_at']));
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

    
    public function delete(Request $req)
    {
        $blog = Blog::findOrFail($req->id);
        
        if (!empty($blog->image) && file_exists(base_path('assets/front/images/blog/') . $blog->image)) {
            unlink(base_path('assets/front/images/blog/') . $blog->image);
        }
        
        $deleted = $blog->delete();

        if ($deleted) {
            return back()->with('success', 'Blog Deleted Successfully!');
        } else {
            return back()->with('error', 'Blog not Deleted!');
        }
    }

    private function uploadFileNormally($req, $field, $blog, $folder = 'assets/front/images/blog/')
    {
        $path = base_path($folder);

        if (!empty($blog->$field) && file_exists($path . $blog->$field)) {
            unlink($path . $blog->$field);
        }

        $file = $req->file($field);
        $name = time() . "_$field." . $file->getClientOriginalExtension();
        $file->move($path, $name);

        $blog->$field = $name;
    }

    private function uploadFileWebp($req, $field, $blog, $folder = 'assets/front/images/blog/')
    {
        $path = base_path($folder);

        if (!empty($blog->$field) && file_exists($path . $blog->$field)) {
            unlink($path . $blog->$field);
        }

        $file = $req->file($field);
        $ext  = strtolower($file->getClientOriginalExtension());

        $name = time() . "_$field.webp";
        $fullPath = $path . $name;

        if (in_array($ext, ['jpg', 'jpeg'])) {
            $img = imagecreatefromjpeg($file->getPathname());
        } elseif ($ext === 'png') {
            $img = imagecreatefrompng($file->getPathname());
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        } elseif ($ext === 'gif') {
            $img = imagecreatefromgif($file->getPathname());
        } else {
            // fallback: save original
            $file->move($path, time() . "_$field.$ext");
            $blog->$field = time() . "_$field.$ext";
            return;
        }

        imagewebp($img, $fullPath, 80);
        imagedestroy($img);

        $blog->$field = $name;
    }
}
