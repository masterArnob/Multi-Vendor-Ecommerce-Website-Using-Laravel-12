<?php

namespace App\Providers;

use App\Models\PaymentSettings;
use App\Models\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $settings = Settings::first();

        Config::set('app.timezone', $settings->time_zone ?? 'UTC');

       $paymentSettings = PaymentSettings::all()->pluck('value', 'key')->toArray();

        // Override PayPal config if settings exist
        if ($paymentSettings) {
            Config::set('paypal.mode', $paymentSettings['paypal_mode'] ?? 'sandbox');
            Config::set('paypal.sandbox.client_id', $paymentSettings['paypal_client_id'] ?? '');
            Config::set('paypal.sandbox.client_secret', $paymentSettings['paypal_client_secret'] ?? '');
            Config::set('paypal.sandbox.app_id', $paymentSettings['paypal_app_id'] ?? 'APP-80W284485P519543T');
            Config::set('paypal.live.client_id', $paymentSettings['paypal_client_id'] ?? ''); // Adjust if separate live credentials
            Config::set('paypal.live.client_secret', $paymentSettings['paypal_client_secret'] ?? '');
            Config::set('paypal.live.app_id', $paymentSettings['paypal_app_id'] ?? '');
            Config::set('paypal.currency', $paymentSettings['paypal_currency'] ?? 'USD');
            Config::set('paypal.payment_action', $paymentSettings['paypal_payment_action'] ?? 'Sale'); // Add if needed
            Config::set('paypal.validate_ssl', isset($paymentSettings['paypal_validate_ssl']) ? (bool) $paymentSettings['paypal_validate_ssl'] : false);
        }

        View::composer('*', function($view) use ($settings, $paymentSettings){
            $view->with(['settings' => $settings, 'paymentSettings' => $paymentSettings]);
        });
    }
}
