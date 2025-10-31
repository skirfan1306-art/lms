<?php

namespace App\Http\Controllers\Mail;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UserMailController extends Controller
{
    public function verificationMail($user)
    {
        $verificationUrl = route('front.verify.mail', $user->verification_token);

        try {
            $data = [
                'userName'        => $user->name,
                'verificationUrl' => $verificationUrl,
            ];

            Mail::send('mailTemplates.userMailVerification', $data, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verify Your Email');
            });

            Log::info("✅ Verification mail sent to {$user->email}");

        } catch (\Throwable $e) {
            Log::error('❌ Verify Mail sending failed: ' . $e->getMessage());
        }
    }


    public function wellcomeMail($toEmail)
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

public function addAdminMail($toEmail)
{
    try {
        $data = [
            'activationUrl' => route('admin.register', ['email' => $toEmail])
        ];

        Mail::send('mailTemplates.adminRegister', $data, function ($message) use ($toEmail) {
            $message->to($toEmail)
                    ->subject('Create Your Account');
        });

        Log::info("✅ Admin Register mail sent to: {$toEmail}");

    } catch (\Throwable $e) {
        Log::error('❌ Admin Register Mail sending failed: ' . $e->getMessage());
    }
}

}