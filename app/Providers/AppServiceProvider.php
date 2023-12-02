<?php

namespace App\Providers;

use App\Models\Allocation;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            if ($this->app->environment('local')) {
                $this->app->register(TelescopeServiceProvider::class);
            }
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Allocation::observe(\App\Observers\AllocationObserver::class);
        
        Select::configureUsing(function (Select $select) {
            $select->native(false);
        });
    }
}
