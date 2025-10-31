<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminMailController extends Controller
{
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
