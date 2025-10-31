<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (Schema::hasTable('mail_settings')) {
            $settings = MailSetting::first();

            if ($settings) {
                // Configure SMTP
                Config::set('mail.default', 'smtp'); // set default driver

                Config::set('mail.mailers.smtp', [
                    'transport'  => $settings->mailer ?? 'smtp',
                    'host'       => $settings->host,
                    'port'       => $settings->port,
                    'encryption' => $settings->encryption,
                    'username'   => $settings->username,
                    'password'   => $settings->password,
                ]);

                // From address
                Config::set('mail.from', [
                    'address' => $settings->from_address,
                    'name'    => $settings->from_name ?? config('app.name'),
                ]);
            }
        }
    }
}
