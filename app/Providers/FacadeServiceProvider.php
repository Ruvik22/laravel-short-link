<?php

namespace App\Providers;

use App\Facades\TinyLink\TinyLinkLogic;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Regist tiny link facade
        $this->app->bind('TinyLink',function(){
            return new TinyLinkLogic();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
