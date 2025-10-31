<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactForm;
use App\Models\ContactPageSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    
public function index()
{
    $contact = ContactPageSetting::first();
    return view('admin.contact.pageSetting', compact('contact'));
}
public function form()
{
    $contact = ContactForm::orderBy('id', 'desc')->get();
    return view('admin.contact.form', compact('contact'));
}

public function update(Request $req)
{
    $req->validate([
        'banner'       => 'image',
        'banner_alt'       => 'required',
        'bannerh1'       => 'required',
        'sec1h1'       => 'required',
        'map_link'       => 'required',
    ]);

    $setting = ContactPageSetting::first();
    $setting->fill($req->only(['banner_alt', 'bannerh1', 'sec1h1', 'map_link']));

    foreach (['banner'] as $field) {
        if ($req->has('make_webp')) {
            $this->uploadFileWebp($req, $field, $setting);
        } else {
            $this->uploadFileNormally($req, $field, $setting);
        }
    }

    $setting->save();

    return back()->with($setting ? 'success' : 'error', $setting ? 'Contact Page Settings updated successfully!' : 'Contact Page Settings not updated!');
}

public function formDelete(Request $req)
{

    $setting = ContactForm::findOrFail($req->id);

    $setting->delete();

    return back()->with($setting ? 'success' : 'error', $setting ? 'Contact message deleted successfully!' : 'Contact message not deleted!');
}

private function uploadFileNormally($req, $field, $setting, $folder = 'assets/front/images/contactpage/')
{
    if ($req->hasFile($field)) {
        $path = base_path($folder);

        if (!empty($setting->$field) && file_exists($path.$setting->$field)) {
            unlink($path.$setting->$field);
        }

        $file = $req->file($field);
        $name = time()."_$field.".$file->getClientOriginalExtension();
        $file->move($path, $name);

        $setting->$field = $name;
    }
}

private function uploadFileWebp($req, $field, $setting, $folder = 'assets/front/images/contactpage/')
{
    if ($req->hasFile($field)) {
        $path = base_path($folder);

        if (!empty($setting->$field) && file_exists($path.$setting->$field)) {
            unlink($path.$setting->$field);
        }

        $file = $req->file($field);
        $ext = strtolower($file->getClientOriginalExtension());

        $name = time()."_$field.webp";
        $fullPath = $path . $name;

        if (in_array($ext, ['jpg','jpeg'])) {
            $img = imagecreatefromjpeg($file->getPathname());
        } elseif ($ext == 'png') {
            $img = imagecreatefrompng($file->getPathname());
            imagepalettetotruecolor($img); // helps with quality
            imagealphablending($img, true);
            imagesavealpha($img, true);
        } elseif ($ext == 'gif') {
            $img = imagecreatefromgif($file->getPathname());
        } else {
            $file->move($path, time()."_$field.".$ext);
            $setting->$field = time()."_$field.".$ext;
            return;
        }

        imagewebp($img, $fullPath, 80);
        imagedestroy($img);

        $setting->$field = $name;
    }
}


 

    
}