<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ItemObserver;

use App\Models\Item;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         Item::observe(ItemObserver::class);
    }
}
