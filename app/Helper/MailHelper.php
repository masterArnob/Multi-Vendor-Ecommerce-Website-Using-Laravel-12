<?php
namespace App\Helper;

use App\Models\SMTPConfig;

class MailHelper
{
   public static function setMailConfig()
{
    $mailConfig = SMTPConfig::first();
    
    if (!$mailConfig) {
        \Log::error('No SMTPConfig found in the database.');
        return;
    }

    $config = [
        'transport' => 'smtp',
        'host' => $mailConfig->host,
        'port' => $mailConfig->port,
        'username' => $mailConfig->username,
        'password' => $mailConfig->password,
        'timeout' => null,
        'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
    ];

    config(['mail.mailers.smtp' => $config]);
    config(['mail.from.address' => $mailConfig->email]);
    config(['mail.from.name' => $mailConfig->name]);

    // Forget old instances so new config is used
    app()->forgetInstance('mail.manager');
    app()->forgetInstance(\Illuminate\Contracts\Mail\Factory::class);
    app()->forgetInstance(\Illuminate\Contracts\Mail\Mailer::class);
    app()->forgetInstance(\Illuminate\Mail\Mailer::class);

    \Log::info('Mail Config Set: ', [
        'mailer' => config('mail.mailers.smtp'),
        'from_address' => config('mail.from.address'),
        'from_name' => config('mail.from.name'),
    ]);
}

}