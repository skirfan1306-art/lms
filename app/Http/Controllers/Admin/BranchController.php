<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class BranchController extends Controller
{
    public function index(){
        $branch = Branch::all();
        return view('admin.branch.index', compact('branch'));
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required|unique:branches,name'
        ]);
        $branch = new Branch();

        $branch->name = $req->name;
        $branch->number = $req->number;
        $branch->mail = $req->mail;
        $branch->address = $req->address;
        if ($req->hasFile('image')) {
            if ($req->has('make_webp')) {
                $this->uploadFileWebp($req, 'image', $branch);
            } else {
                $this->uploadFileNormally($req, 'image', $branch);
            }
        }

        if($branch->save()){
            return redirect()->back()->withSuccess('Branch Added Succesfully.');
        }else{
            return redirect()->back()->withError('Branch Not Added.');
        }

    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => [
                'required',
                Rule::unique('branches', 'name')->ignore($req->id),
            ],
        ]);

        $branch = Branch::findOrFail($req->id);

        $branch->name = $req->name;
        $branch->number = $req->number;
        $branch->mail = $req->mail;
        $branch->address = $req->address;

        if ($req->hasFile('image')) {
            if ($req->has('make_webp')) {
                $this->uploadFileWebp($req, 'image', $branch);
            } else {
                $this->uploadFileNormally($req, 'image', $branch);
            }
        }

        if($branch->save()){
            return redirect()->back()->withSuccess('Branch Update Succesfully.');
        }else{
            return redirect()->back()->withError('Branch Not Update!');
        }

    }
    public function toggleStatus(Request $req)
    {
        $branch = Branch::findOrFail($req->id);
        $branch->status = $branch->status == 1 ? 0 : 1;

        if ($branch->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    public function delete(Request $req)
    {
        $branch = Branch::findOrFail($req->id);
        $path = base_path('assets/front/images/branch/');
        if (!empty($branch->image) && file_exists($path . $branch->image)) {
            unlink($path . $branch->image);
        }
        if ($branch->delete()) {
            return redirect()->back()->withSuccess('Branch Deleted successfully.');
        } else {
            return redirect()->back()->withError('Branch Not Deleted!');
        }
    }


    private function uploadFileNormally($req, $field, $branch, $folder = 'assets/front/images/branch/')
    {
        $path = base_path($folder);

        if (!empty($branch->$field) && file_exists($path . $branch->$field)) {
            unlink($path . $branch->$field);
        }

        $file = $req->file($field);
        $name = time() . uniqid() . "." . $file->getClientOriginalExtension();
        $file->move($path, $name);

        $branch->$field = $name;
    }

    private function uploadFileWebp($req, $field, $branch, $folder = 'assets/front/images/branch/')
    {
        $path = base_path($folder);

        if (!empty($branch->$field) && file_exists($path . $branch->$field)) {
            unlink($path . $branch->$field);
        }

        $file = $req->file($field);
        $ext  = strtolower($file->getClientOriginalExtension());

        $name = time() . uniqid() . ".webp";
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
            $branch->$field = time() . "_$field.$ext";
            return;
        }

        imagewebp($img, $fullPath, 80);
        imagedestroy($img);

        $branch->$field = $name;
    }

}