<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\SiteSetting;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    // ----- ** Auth Start ***** --------//
    public function login()
    {
        return view('admin.login');
    }
    public function register($email)
    {
        $admin = Admin::where('email', $email)->first();

        if (!$admin) {
            return redirect()->route('admin.login')->withError('Admin not found or Invalid URL!');
        }

        return view('admin.register', compact('email'));
    }

    public function forgot()
    {
        return view('admin.forgot');
    }
    public function otpForm($email)
    {
        return view('admin.verifyotp', compact('email'));
    }
    public function resetForm()
    {
        return view('admin.updatepassword');
    }
    // ----- ** Auth End ***** --------//
    
    public function dashboard()
    {
        return view('admin.index');
    }
    public function profile()
    {
        return view('admin.profile');
    }

    public function manageAdmin()
    {
        $admins = Admin::latest('id')->get();
        return view('admin.admins', compact('admins'));
    }
    public function siteSetting()
    {
        $setting = SiteSetting::first();
        return view('admin.siteSetting', compact('setting'));
    }
    public function mailSetting()
    {
        $setting = MailSetting::first();
        return view('admin.mailSetting', compact('setting'));
    }
    

}
