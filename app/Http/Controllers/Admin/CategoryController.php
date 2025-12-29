<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::withCount('course')->withCount('subcategory')->get();
    
        if (Route::is('admin.category*')) {
            return view('admin.course.category', compact('category'));
        }
    
        if (Route::is('instructor.category*')) {
            return view('instructor.course.category', compact('category'));
        }
    
        abort(404);
    }


    public function addCategory(Request $req){
        $req->validate([
            'category' => 'required|unique:categories,name',
            'image'    => 'required|max:2048',
        ]);
        $category = new Category();

        $category->name = $req->category;
        $category->slug = Str::slug($req->category, '-');
        
        if ($req->hasFile('image')) {
            $imageName = time() . 'C' . uniqid() . '.' . $req->image->extension();
            $req->image->move(base_path('assets/front/images/category/'), $imageName);
            $category->image = $imageName;
        }

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
                Rule::unique('categories', 'name')->ignore($req->id),
            ],
        ]);

        $category = Category::findOrFail($req->id);

        $category->name = $req->category;
        $category->slug = Str::slug($req->category, '-');
        
        if ($req->hasFile('image')) {
            $oldThumbPath = base_path('assets/front/images/category/' . $category->image);
            if ($category->image && file_exists($oldThumbPath)) {
                unlink($oldThumbPath);
            }
        
            $imageName = time() . 'C' . uniqid() . '.' . $req->image->extension();
            $req->image->move(base_path('assets/front/images/category/'), $imageName);
        
            $category->image = $imageName;
        }

        if($category->save()){
            return redirect()->back()->withSuccess('Category Update Succesfully.');
        }else{
            return redirect()->back()->withError('Category Not Update!');
        }

    }
    public function toggleHeaderStatus(Request $req)
    {
        $category = Category::findOrFail($req->id);
        $category->show_in_header = $category->show_in_header == '1' ? '0' : '1';

        if ($category->save()) {
            return redirect()->back()->withSuccess('Header Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Header Status Not Updated!');
        }
    }
    public function toggleStatus(Request $req)
    {
        $category = Category::findOrFail($req->id);
        $category->status = $category->status == 1 ? 0 : 1;

        if ($category->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function delete(Request $req)
    {
        $category = Category::findOrFail($req->id);
        if ($category->delete()) {
            return redirect()->back()->withSuccess('Category Deleted successfully.');
        } else {
            return redirect()->back()->withError('Category Not Deleted!');
        }
    }


}
