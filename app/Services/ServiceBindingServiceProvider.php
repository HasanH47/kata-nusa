<?php

namespace App\Services;

use App\Services\Auth\AuthService;
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

        // Tambahkan binding untuk service classes lainnya di sini
        // Contoh:
        // $this->app->bind(PostService::class, function ($app) {
        //     return new PostService();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
