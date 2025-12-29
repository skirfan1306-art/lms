<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class SubcategoryController extends Controller
{
    public function index($slug = null){
        
        if($slug){
            $cat0 = Category::where('slug', $slug)->first();
            $cat = Category::where('slug', $slug)->get();
            $name = $cat0->name;
            $subcategory = Subcategory::where('category_id', $cat0->id)->get();
        }else{
            $cat = Category::orderBy('name', 'asc')->get();
            $name = "All";
            $subcategory = Subcategory::all();
        }
        
        if (Route::is('admin.subcategory*')) {
            return view('admin.course.subcategory', compact('subcategory', 'cat', 'name'));
        }
    
        if (Route::is('instructor.subcategory*')) {
            return view('instructor.course.subcategory', compact('subcategory', 'cat', 'name'));
        }
    
        abort(404);
    }

    public function create(Request $req){
        $req->validate([
            'category_id' => 'required',
            'name' => 'required|unique:subcategories,name'
        ]);
        $subcategory = new Subcategory();

        $subcategory->name = $req->name;
        $subcategory->category_id = $req->category_id;
        $subcategory->slug = Str::slug($req->name, '-');

        if($subcategory->save()){
            return redirect()->back()->withSuccess('Subcategory Added Succesfully.');
        }else{
            return redirect()->back()->withError('Subcategory Not Added.');
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

        $subcategory = Subcategory::findOrFail($req->id);

        $subcategory->name = $req->name;
        $subcategory->category_id = $req->category_id;
        $subcategory->slug = Str::slug($req->name, '-');

        if($subcategory->save()){
            return redirect()->back()->withSuccess('Subcategory Update Succesfully.');
        }else{
            return redirect()->back()->withError('Subcategory Not Update!');
        }

    }
    public function toggleHeaderStatus(Request $req)
    {
        $subcategory = Subcategory::findOrFail($req->id);
        $subcategory->show_in_header = $subcategory->show_in_header == '1' ? '0' : '1';

        if ($subcategory->save()) {
            return redirect()->back()->withSuccess('Header Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Header Status Not Updated!');
        }
    }
    public function toggleStatus(Request $req)
    {
        $subcategory = Subcategory::findOrFail($req->id);
        $subcategory->status = $subcategory->status == 1 ? 0 : 1;

        if ($subcategory->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function delete(Request $req)
    {
        $subcategory = Subcategory::findOrFail($req->id);
        if ($subcategory->delete()) {
            return redirect()->back()->withSuccess('Subcategory Deleted successfully.');
        } else {
            return redirect()->back()->withError('Subcategory Not Deleted!');
        }
    }


}
