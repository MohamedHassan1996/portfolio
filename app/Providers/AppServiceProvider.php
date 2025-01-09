<?php

namespace App\Providers;

use App\Enums\FrontPage\FrontPageStatus;
use App\Models\FrontPage\FrontPage;
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

        view()->share('navbarLinks', $frontPage);
    }
}
