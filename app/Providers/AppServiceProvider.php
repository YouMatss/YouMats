<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register() {
        Schema::defaultStringLength(191);
    }

    public function boot() {
//        Category::fixTree();
        Paginator::useBootstrap();
    }
}
