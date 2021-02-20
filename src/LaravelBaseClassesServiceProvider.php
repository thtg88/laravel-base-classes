<?php

namespace Thtg88\LaravelBaseClasses;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper;
use Thtg88\LaravelBaseClasses\Validators\Validator;

class LaravelBaseClassesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/base-classes.php' => Container::getInstance()
                ->configPath('base-classes.php'),
        ], 'base-classes-config');

        // Register custom validator
        app('validator')->resolver(static function ($translator, $data, $rules, $messages) {
            return new Validator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/base-classes.php',
            'base-classes'
        );

        // Register journal entry helper singleton
        $this->app->singleton('JournalEntryHelper', static function ($app) {
            return $app->make(JournalEntryHelper::class);
        });
    }
}
