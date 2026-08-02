<?php

namespace App\Providers;

use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        $generalSetting = GeneralSetting::first();
        $logoSetting = LogoSetting::first();
        $mailSetting = EmailSetting::first();

        /** Share variable at all view */
        View::composer('*', function($view) use ($generalSetting, $logoSetting, $mailSetting){
            $view->with([
                'settings' => $generalSetting,
                'logoSetting' => $logoSetting,
                'mailSetting' => $mailSetting,
            ]);
        });
    }
}
