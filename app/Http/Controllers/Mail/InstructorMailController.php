<?php

namespace App\Http\Controllers\Mail;

use App\Models\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InstructorMailController extends Controller
{

    public function wellcomeMail($instructor, $password)
    {
        try {
            $data = [
                'name'     => $instructor->name,
                'email'    => $instructor->email,
                'password' => $password,
            ];
    
            Mail::send('mailTemplates.instructorWelcome', $data, function ($message) use ($instructor) {
                $message->to($instructor->email)
                        ->subject('Welcome Instructor');
            });
    
            Log::info("✅ Instructor welcome mail sent to: {$instructor->email}");
    
        } catch (\Throwable $e) {
            Log::error('❌ Mail sending failed: ' . $e->getMessage());
        }
    }



    public function sendOtpMail($toEmail, $otp)
    {
        try {
            $data = ['otp' => $otp];

            Mail::send('mailTemplates.adminForgotOtp', $data, function ($message) use ($toEmail) {
                $message->to($toEmail)
                        ->subject('Your Password Reset OTP');
            });

            Log::info("✅ OTP mail sent to: {$toEmail}");

        } catch (\Throwable $e) {
            Log::error('❌ Mail sending failed: ' . $e->getMessage());
        }
    }

}