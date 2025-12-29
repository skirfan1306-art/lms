<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Mail\UserMailController;
use Illuminate\Support\Facades\Validator;


class InstructorAuth extends Controller
{
    

public function instructorLogin(){
    return view('instructor.login');
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

    $instructor = Instructor::where('email', $req->email)->first();

    if (!$instructor) {
            return back()->with('error', 'No account found with these credentials.')->withInput();
    }

    if ($instructor->verified != 1) {
            return back()->with('error', 'Account is not verified. Please contact our support team.')->withInput();
    }
    
    if ($instructor->status != 1) {
            return back()->with('error', 'Account is Ban. Please contact our support team.')->withInput();
    }

    if (Auth::guard('instructor')->attempt(['email' => $req->email, 'password' => $req->password])) {
        return redirect()->route('instructor.dashboard')->with('success', 'Login successful!');
    } else {
            return back()->with('error', 'Invalid password. Please try again.')->withInput();
    }
}

    public function forget(){
        return view('instructor.forgot-password');
    }
    public function logout()
    {
        Auth::guard('instructor')->logout();
        return redirect()->route('instructor.login'); 
    }


 public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $user = Instructor::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => $request->email . ' not register as a Instructor'
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
        
  

        $user = Instructor::where('email', $request->email)->first();

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

        $user = Instructor::where('email', $email)->first();
        if (!$user) {
             return response()->json([
                'status' => 'error',
                'message' => 'instructor not found!'
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