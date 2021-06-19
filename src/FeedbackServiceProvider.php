<?php

namespace AndreasElia\Feedback;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FeedbackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/feedback.php' => config_path('feedback.php'),
            ], 'feedback-config');

            $this->publishes([
                __DIR__.'/../public/' => public_path('vendor/feedback'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/feedback'),
            ], 'feedback-assets');
        }

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Routes
        Route::group($this->routeConfig(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

        // Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'feedback');

        // Blade Directives
        Blade::directive('feedbackStyles', function ($expression) {
            return '<link href="'.asset('vendor/feedback/css/app.css').'" rel="stylesheet">';
        });
        Blade::directive('feedbackScripts', function ($expression) {
            $scripts = '<script src="'.asset('vendor/feedback/js/app.js').'" defer></script>';
            $scripts .= '<script src="'.asset('vendor/feedback/js/235.js').'" defer></script>';
            return $scripts;
        });
    }

    protected function routeConfig(): array
    {
        return [
            'namespace' => 'AndreasElia\Feedback\Http\Controllers',
            'prefix' => config('feedback.prefix'),
            'middleware' => config('feedback.middleware'),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Config
        $this->mergeConfigFrom(
            __DIR__.'/../config/feedback.php', 'feedback'
        );
    }
}
