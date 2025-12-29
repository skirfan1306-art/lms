<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        $category = BlogCategory::all();
        return view('admin.blog.create', compact('category'));
    }

    public function show()
    {
        $blog = Blog::withCount('comments')->get();
        $category = BlogCategory::all();
        
        return view('admin.blog.index', compact('blog', 'category'));
    }
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $category = BlogCategory::all();
        
        return view('admin.blog.edit', compact('blog', 'category'));
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
        $tags = collect(explode(',', $req->tags))->map(fn($t) => trim($t))->filter()->values()->toJson();
        $blog->tags = $tags;

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
        $tags = collect(explode(',', $req->tags))->map(fn($t) => trim($t))->filter()->values()->toJson();
        $blog->tags = $tags;
    
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
    
    
    // ---------  Blog Category --------- //
    
    public function categoryIndex(){
        $category = BlogCategory::withCount('blogs')->get();

        return view('admin.blog.category', compact('category'));
    }

    public function addCategory(Request $req){
        $req->validate([
            'category' => 'required|unique:blog_categories,name'
        ]);
        $category = new BlogCategory();

        $category->name = $req->category;
        $category->slug = Str::slug($req->category, '-');

        if($category->save()){
            return redirect()->back()->withSuccess('Category Added Succesfully.');
        }else{
            return redirect()->back()->withError('Category Not Added.');
        }

    }

    public function updateCategory(Request $req)
    {
        $req->validate([
            'category' => [
                'required',
                Rule::unique('blog_categories', 'name')->ignore($req->id),
            ],
        ]);

        $category = BlogCategory::findOrFail($req->id);

        $category->name = $req->category;
        $category->slug = Str::slug($req->category, '-');

        if($category->save()){
            return redirect()->back()->withSuccess('Category Update Succesfully.');
        }else{
            return redirect()->back()->withError('Category Not Update!');
        }

    }
    
    public function categoryStatus(Request $req)
    {
        $category = BlogCategory::findOrFail($req->id);
        $category->status = $category->status == '1' ? '0' : '1';
    
        if ($category->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function categoryDelete(Request $req)
    {
        $category = BlogCategory::findOrFail($req->id);
        if ($category->delete()) {
            return redirect()->back()->withSuccess('Category Deleted successfully.');
        } else {
            return redirect()->back()->withError('Category Not Deleted!');
        }
    }
    
    // --------- Comments --------- //
    public function comments($id)
    {
        $comments = BlogComment::with('blog')->where('blog_id', $id)->get();
        $blog = Blog::findOrFail($id);
        
        return view('admin.blog.comment', compact('comments', 'blog'));
    }
    
    public function commentStatus(Request $req)
    {
        $category = BlogComment::findOrFail($req->id);
        $category->status = $category->status == '1' ? '0' : '1';
    
        if ($category->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function commentDelete(Request $req)
    {
        $category = BlogComment::findOrFail($req->id);
        if ($category->delete()) {
            return redirect()->back()->withSuccess('Comment Deleted successfully.');
        } else {
            return redirect()->back()->withError('Comment Not Deleted!');
        }
    }

}
