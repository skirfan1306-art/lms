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
    
    public function register(){
        return view('front.register');
    }
    public function registerAction(Request $req)
    {
        $validated = $req->validate([
            'number'   => 'required|string|unique:users,number|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => [
                            'required',
                            'confirmed',
                            'min:8',
                            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
                        ],
            'term' => 'required',
        ], [
            'email.required' => 'We need your email address.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email is already registered. Try logging in instead.',
            'number.unique'   => 'This Mobile Number is already registered. Try logging in instead.',
           'password.confirmed' => 'Passwords do not match.',
            'password.min'       => 'Password must be at least :min characters long.',
            'password.regex'     => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.',
     
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

       return redirect()->back()->with('success', 'Your account has been created successfully! We’ve sent a verification link to your email. Please check your inbox and verify your email address to continue.');

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

        Auth::guard('web')->login($user);

        return redirect()->route('front.dashboard')->with('success', 'Your email has been verified successfully!');
    }

public function renderLogin(){
    return view('front.login');
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
            return back()->with('error', 'No account found with these credentials.')->withInput();
    }

    // Check if user is active
    if ($user->email_verified_at == null || $user->email_verified_at == '') {
            return back()->with('error', 'Account is not active yet. Please verify your email to activate your account.')->withInput();
    }
    
    if ($user->status != 1) {
            return back()->with('error', 'Account is deactive. Please contact our support team.')->withInput();
    }

    // Attempt login
    if (Auth::guard('web')->attempt(['email' => $req->email, 'password' => $req->password])) {
        return redirect()->route('front.dashboard')->with('success', 'Login successful!');
    } else {
            return back()->with('error', 'Invalid password. Please try again.')->withInput();
    }
}

    public function forget(){
        return view('front.forgot-password');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login'); 
    }


    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $user = user::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => $request->email . ' not register as a user'
            ]);
        }
    
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->save();
    
        // Send OTP mail
        (new UserMailController)->sendOtpMail($user->email, $otp);
    
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent to your email',
            'email' => $user->email
        ]);
    }



    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required'
        ]);
        
  

        $user = user::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp) {
             return response()->json([
            'status' => 'error',
            'message' => 'Invalid or expired OTP'
            ]);
            
        }

        session()->put('forgot-email', $user->email);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified! Set new password.'
            ]);
    }
    
    

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => [
                            'required',
                            'confirmed',
                            'min:8',
                            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
                        ],
        ], [
            'password.confirmed' => 'Passwords do not match.',
            'password.min'       => 'Password must be at least :min characters long.',
            'password.regex'     => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.'
            
        ]);
        
      

        $email = session('forgot-email');
        if (!$email) {
            return response()->json([
                'status' => 'error',
                'message' => 'Session expired, please try again.'
                ]); 
        }

        $user = user::where('email', $email)->first();
        if (!$user) {
             return response()->json([
                'status' => 'error',
                'message' => 'User not found!'
                ]);  
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        session()->forget('forgot-email');

         return response()->json([
            'status' => 'success',
            'message' => 'Password Successfully Reset'
            ]);
    }


    
}
