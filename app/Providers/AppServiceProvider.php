<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        $path = '';
        $arr = explode("/", $request->path());

        if(count($arr) > 0) {
            $path = $arr[0];
        }

        View::share(['path' => $path]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
