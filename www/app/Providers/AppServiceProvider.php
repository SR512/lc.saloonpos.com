<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            $settings = Settings::all()->first();
            $filedir = config('constants.SITE_LOGO_URI');
            config([
                'global' => [
                    'site_logo' => asset($filedir . $settings->site_logo),
                    'name' => $settings->name,
                    'gst' => $settings->gst,
                    'email' => $settings->email,
                    'mobile' => $settings->mobile,
                    'address' => $settings->address,
                ]

            ]);
        }
    }
}
