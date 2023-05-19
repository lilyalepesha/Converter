<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Helpers\Telegram;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        /*
        $this->app->bind(Telegram::class, function (){
            return new Telegram("5505332253:AAFUClHhn_E7p-UAFYg3acumeJhwza8jzJ0");
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function(){
            return auth()->user()->role === RoleEnum::ADMIN->value;
        });

        Paginator::useBootstrapFive();
    }
}
