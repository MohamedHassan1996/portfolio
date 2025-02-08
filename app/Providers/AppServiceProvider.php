<?php

namespace App\Providers;

use App\Enums\FrontPage\FrontPageStatus;
use App\Models\FrontPage\FrontPage;
use App\Models\MainSetting\MainSetting;
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
        $frontPage = FrontPage::with('translations')->where('is_active', FrontPageStatus::ACTIVE)->get();
        $mainSettings = MainSetting::first();
        view()->share([
            'navbarLinks' => $frontPage,
            'mainSettings' => $mainSettings
        ]);
    }
}
