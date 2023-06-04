<?php

namespace App\Providers;

use App\Models\StaticImage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register() {
        Schema::defaultStringLength(191);
    }

    public function boot() {
        Paginator::useBootstrap();
        try {

            setCityUsingLocation();

            $data['staticImages'] = StaticImage::with('media')->first();

            View::share($data);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
