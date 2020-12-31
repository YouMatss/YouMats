<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('logs', function ($referencing_column = 'users.id', $usesSoftDeletes = 0) {
            $ref_table = explode('.', $referencing_column)[0];
            $primary_key = explode('.', $referencing_column)[1];

            $this->bigInteger('created_by')->unsigned()->nullable()->index();
            $this->foreign('created_by')->references($primary_key)->on($ref_table);

            $this->bigInteger('updated_by')->unsigned()->nullable()->index();
            $this->foreign('updated_by')->references($primary_key)->on($ref_table);

            if($usesSoftDeletes){
                $this->bigInteger('deleted_by')->unsigned()->nullable()->index();
                $this->foreign('deleted_by')->references($primary_key)->on($ref_table);
            }
        });
    }
}
