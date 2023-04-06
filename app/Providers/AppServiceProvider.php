<?php

namespace App\Providers;


use App\Services\MenuCounts;
use App\Services\Setting\Setting;
use App\Services\FirebaseMessaging;
use App\Services\Fyers;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        // $this->app->singleton('fcm',function(){
        //     return new FirebaseMessaging();
        // });
            
       
        $this->app->singleton('menuCounts',function(){
            return new MenuCounts;
        });

        $this->app->singleton('fyers',function(){
            return new Fyers;
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //by default laravel 8 use tailwind pagination, use below command to use bootstrap pagination
        Paginator::useBootstrap();

        if (App::environment('local')) {
            //activity()->log('App ServiceProvider boot method ,Activity will log in local enviorment');
        }

        //Binding of services
        app()->bind('Hello',function(){
            return 'Helloooooooos';
        });

        JsonResource::withoutWrapping();

    }
}
