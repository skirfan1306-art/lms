<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Mail\UserMailController;

class UserAuth extends Controller
{
    public function registerAction(Request $req)
    {
        $validated = $req->validate([
            'name'     => 'required|string|max:255',
            'number'   => 'required|string|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ], [
            'email.required' => 'We need your email address.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email is already registered. Try logging in instead.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min'   => 'Password must be at least :min characters long.',
        ]);

        $token = Str::random(64);

        $user = User::create([
            'name'               => $validated['name'],
            'email'              => $validated['email'],
            'number'             => $validated['number'],
            'email_verified_at'  => null,
            'verification_token' => $token,
            'status'             => 0,
            'password'           => Hash::make($validated['password']),
        ]);
        
        // Send verification email
        (new UserMailController)->verificationMail($user);

        return response()->json([
            'success' => true,
            'message' => 'Your account has been created successfully! We’ve sent a verification link to your email. Please check your inbox and verify your email address to continue.'
        ]);
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid or expired verification link.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->status = 1;
        $user->save();

        Auth::login($user);

        return redirect()->route('front.dashboard')->with('success', 'Your email has been verified successfully!');
    }


public function loginAction(Request $req)
{
    $req->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ], [
        'email.required' => 'Please enter your email.',
        'password.required' => 'Please enter your password.',
    ]);

    // Check if user exists
    $user = User::where('email', $req->email)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'No account found with these credentials.'
        ]);
    }

    // Check if user is active
    if ($user->status != 1) {
        return response()->json([
            'success' => false,
            'message' => 'Your account is not active yet. Please verify your email to activate your account.'
        ]);
    }

    // Attempt login
    if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect_url' => route('front.dashboard')
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Invalid password. Please try again.'
        ]);
    }
}


    public function logout()
    {
        Auth::guard('user')->logout();
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
