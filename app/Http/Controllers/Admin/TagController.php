<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class TagController extends Controller
{
    public function index(){
        $tag = Tag::all();
        
        if (Route::is('admin.tag*')) {
            return view('admin.course.tag', compact('tag'));
        }
    
        if (Route::is('instructor.tag*')) {
            return view('instructor.course.tag', compact('tag'));
        }
    
        abort(404);
        
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required|unique:tags,name'
        ]);
        $tag = new Tag();

        $tag->name = $req->name;
        $tag->slug = Str::slug($req->name, '-');

        if($tag->save()){
            return redirect()->back()->withSuccess('Tag Added Succesfully.');
        }else{
            return redirect()->back()->withError('Tag Not Added.');
        }

    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('subcategories', 'name')->ignore($req->id),
            ],
            'category_id' => 'required'
        ]);

        $tag = Tag::findOrFail($req->id);

        $tag->name = $req->name;
        $tag->slug = Str::slug($req->name, '-');

        if($tag->save()){
            return redirect()->back()->withSuccess('Tag Update Succesfully.');
        }else{
            return redirect()->back()->withError('Tag Not Update!');
        }

    }
    public function toggleStatus(Request $req)
    {
        $tag = Tag::findOrFail($req->id);
        $tag->status = $tag->status == 1 ? 0 : 1;

        if ($tag->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function delete(Request $req)
    {
        $tag = Tag::findOrFail($req->id);
        if ($tag->delete()) {
            return redirect()->back()->withSuccess('Tag Deleted successfully.');
        } else {
            return redirect()->back()->withError('Tag Not Deleted!');
        }
    }


}
