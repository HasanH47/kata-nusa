<?php

namespace App\Services;

use App\Services\Auth\AuthService;
use App\Services\Dashboard\Articles\ArticleService;
use App\Services\Dashboard\Profiles\ProfileService;
use Illuminate\Support\ServiceProvider;

class ServiceBindingServiceProvider extends ServiceProvider
{
    /**
     * Daftar service classes yang akan di-binding.
     *
     * @var array
     */
    protected $serviceBindings = [
        // Format: [Abstract/Interface => Concrete Class]
        AuthService::class => AuthService::class,
        ArticleService::class => ArticleService::class,
        ProfileService::class => ProfileService::class
    ];

    /**
     * Register bindings for service classes.
     */
    public function register()
    {
        // Bind service classes ke container Laravel
        foreach ($this->serviceBindings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
