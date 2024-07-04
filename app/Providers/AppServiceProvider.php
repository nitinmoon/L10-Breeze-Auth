<?php

namespace App\Providers;

 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Services\MailConfigurationService;

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
        // Configure mail settings globally
        MailConfigurationService::configureMail();
    }
}
