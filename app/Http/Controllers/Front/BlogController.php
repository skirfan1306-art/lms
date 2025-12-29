<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;

class BlogController extends Controller
{
    
    public function blog(){
        
        $blog = Blog::where('status', '1')->paginate(12);
        return view('front.blog', compact('blog'));
    }
   
    public function blogSingle($id){
      
      $blog = Blog::with('category')
                    ->where('slug', $id)
                    ->where('status', 1)
                    ->first();
      if(!$blog){
        abort(404);
      }
      $recentBlogs = Blog::where('slug', '!=', $id)
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(5)   
                    ->get();
     $allBlog = Blog::where('status', '1')->get();
     $blogCategory = BlogCategory::withCount('blogs')
                    ->where('status', '1')
                    ->where('id','!=',1)
                    ->get();
                    
    
     $blogComment = BlogComment::where('blog_id', $blog->id)
                              ->where('status', '1')
                              ->get();

    

      return view('front.blog-single', compact('blog', 'recentBlogs' , 'allBlog' , 'blogCategory', 'blogComment'));
    }
  
    public function blogTag($id){
        
        $blog = Blog::whereJsonContains('tags', $id)->paginate(12);
        
         $page_title = "Tag: " . $id;
               return view('front.blog', compact('blog', 'page_title'));

    }
    
    
    public function blogCategory($id){ 
    $category = BlogCategory::where('slug', $id)->firstOrFail();

    
    $blog = Blog::where('category_id', $category->id)
                ->where('status', 1)
                ->paginate(12);
                
              $page_title = "Category: " . $category->name;  
        return view('front.blog', compact('blog', 'page_title'));
    }

    public function blogSearch(Request $request) {
        $search = $request->search;
    
    
        $category = BlogCategory::where('name', 'LIKE', "%{$search}%")->first();
    
        
        $blog = Blog::where('status', 1)
            ->where(function ($q) use ($search, $category) {
                $q->where('title', 'LIKE', "%{$search}%");
                $q->orWhereJsonContains('tags', $search);
                if ($category) {
                    $q->orWhere('category_id', $category->id);
                }
            })
            ->paginate(12);
             $page_title = "Search: " . $search;
    
        return view('front.blog', compact('blog', 'page_title'));
    }
    public function commentAdd(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string'
            
            ]);
    
            $comment = new BlogComment();
            
            $comment->blog_id = $id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->comment = $request->comment;
            $comment->created_at = date('Y-m-d');
            $comment->save();
            
            return redirect()->back()->withInput()->with('success', 'Your comment has been submitted.')->withFragment('comments');
    }
    
     

}
