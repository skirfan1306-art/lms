<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SitesettingController extends Controller
{

public function siteUpdate(Request $req)
{
    
    $req->validate([
        'title'       => 'required|string|max:255',
        'email'       => 'required|email',
        'number'      => 'required|numeric',
    ]);

    $setting = SiteSetting::first();
    $setting->fill($req->only(['title', 'email', 'number']));

    foreach (['favicon', 'logo', 'footer_logo'] as $field) {
        $this->uploadFile($req, $field, $setting);
    }

    $setting->save();

    return back()->with($setting ? 'success' : 'error', $setting ? 'Settings updated successfully!' : 'Settings not updated!');
}

private function uploadFile($req, $field, $setting, $folder = 'assets/logo/')
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



public function mailUpdate(Request $req)
{
    $req->validate([
        'mailer'       => 'required|string',
        'host'         => 'required|string',
        'port'         => 'required|numeric',
        'username'     => 'required|string',
        'password'     => 'required|string',
        'encryption'   => 'nullable|string',
        'from_address' => 'required|email',
        'from_name'    => 'required|string',
    ]);

    $setting = MailSetting::first();
    if (!$setting) {
        $setting = new MailSetting();
    }

    $setting->fill($req->only([
        'mailer','host','port','username','password',
        'encryption','from_address','from_name'
    ]));

    $saved = $setting->save();

    return back()->with($saved ? 'success' : 'error',
        $saved ? 'Mail Settings updated successfully!' : 'Settings not updated!'
    );
}

    

    
}
