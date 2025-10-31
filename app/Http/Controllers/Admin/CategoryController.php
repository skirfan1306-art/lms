<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.product.category', compact('category'));
    }

    public function addCategory(Request $req){
        $req->validate([
            'category' => 'required|unique:categories,name'
        ]);
        $category = new Category();

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
                Rule::unique('categories', 'name')->ignore($req->id),
            ],
        ]);

        $category = Category::findOrFail($req->id);

        $category->name = $req->category;
        $category->slug = Str::slug($req->category, '-');

        if($category->save()){
            return redirect()->back()->withSuccess('Category Update Succesfully.');
        }else{
            return redirect()->back()->withError('Category Not Update!');
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
