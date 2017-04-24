<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Http\Validators\HashValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages) {
          return new HashValidator($translator, $data, $rules, $messages);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            // Providers
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // Aliases
            $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
