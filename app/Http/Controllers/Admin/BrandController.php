<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class BrandController extends Controller
{
    public function index(){
        $brand = Brand::all();
        return view('admin.product.brand', compact('brand'));
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required|unique:brands,name'
        ]);
        $brand = new Brand();

        $brand->name = $req->name;
        $brand->slug = Str::slug($req->name, '-');

        if($brand->save()){
            return redirect()->back()->withSuccess('Brand Added Succesfully.');
        }else{
            return redirect()->back()->withError('Brand Not Added.');
        }

    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('brands', 'name')->ignore($req->id),
            ],
        ]);

        $brand = Brand::findOrFail($req->id);

        $brand->name = $req->name;
        $brand->slug = Str::slug($req->name, '-');

        if($brand->save()){
            return redirect()->back()->withSuccess('Brand Update Succesfully.');
        }else{
            return redirect()->back()->withError('Brand Not Update!');
        }

    }
    public function toggleStatus(Request $req)
    {
        $brand = Brand::findOrFail($req->id);
        $brand->status = $brand->status == 1 ? 0 : 1;

        if ($brand->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function delete(Request $req)
    {
        $brand = Brand::findOrFail($req->id);
        if ($brand->delete()) {
            return redirect()->back()->withSuccess('Brand Deleted successfully.');
        } else {
            return redirect()->back()->withError('Brand Not Deleted!');
        }
    }


}
