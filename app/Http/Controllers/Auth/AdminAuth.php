<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Mail\AdminMailController;
use Illuminate\Support\Facades\Cookie;

class AdminAuth extends Controller
{

    public function registerAction(Request $req)
    {
        $validated = $req->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = Admin::where('email', $validated['email'])->update([
            'name'     => $validated['name'],
            'password' => Hash::make($validated['password']),
            'role'     => 'admin',
            'status'   => 1,
        ]);

        return redirect()->route('admin.login')->withSuccess("Admin registered successfully")->withInput();
    }
    


    public function loginAction(Request $req)
    {
        $credentials = $req->only('email', 'password');
        $remember = $req->filled('remember');
        
        $admin = Admin::where('email', $req->email)->first();

        if ($admin && $admin->status == 0) {
            return back()->with('error', 'Your account is deactivated. Please contact the administrator for assistance.')->withInput();
        }


        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            if ($remember) {
                Cookie::queue('chemist_admin_email', $req->email, 43200);
                Cookie::queue('chemist_admin_password', $req->password, 43200);
            } else {
                Cookie::queue(Cookie::forget('chemist_admin_email'));
                Cookie::queue(Cookie::forget('chemist_admin_password'));
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ])->withInput();
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); 
    }


    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withError('Email not found')->withInput();
        }

        $otp = rand(1000, 9999);
        $admin->otp = $otp;
        $admin->save();

        // Send OTP mail
        (new AdminMailController)->sendOtpMail($admin->email, $otp);

        return redirect()->route('admin.forgot.otp', $admin->email)->withSuccess('OTP sent to your email');
    }


    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || $admin->otp !== $request->otp) {
            return back()->withError('Invalid or expired OTP');
        }

        session()->put('forgot-email', $admin->email);

        return redirect()->route('admin.password.reset')->withSuccess('OTP verified! Set new password.');
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('forgot-email');
        if (!$email) {
            return redirect()->route('admin.forgot')->withError('Session expired, please try again.');
        }

        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return back()->withError('Something went wrong');
        }

        $admin->password = Hash::make($request->password);
        $admin->otp = null;
        $admin->save();

        session()->forget('forgot-email');

        return redirect()->route('admin.login')->withSuccess('Password changed successfully. Please login.');
    }


    
}
