<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register() {
        Schema::defaultStringLength(191);
    }

    public function boot() {
        Blueprint::macro('logs', function ($referencing_column = 'users.id', $usesSoftDeletes = 0) {
            $ref_table = explode('.', $referencing_column)[0];
            $primary_key = explode('.', $referencing_column)[1];

            $this->bigInteger('created_by')->unsigned()->nullable()->index  ();
            $this->foreign('created_by')->references($primary_key)->on($ref_table);

            $this->bigInteger('updated_by')->unsigned()->nullable()->index();
            $this->foreign('updated_by')->references($primary_key)->on($ref_table);

            if($usesSoftDeletes){
                $this->bigInteger('deleted_by')->unsigned()->nullable()->index();
                $this->foreign('deleted_by')->references($primary_key)->on($ref_table);
            }
        });

        //Temporary fix (You can't have direct connection to tables in AppServiceProvider.
        // Causes a problem when you freshly install the app.
        try {
            $data['categories'] = Category::with('subCategories')->orderBy('sort')->get();
            $config['currencies'] = Currency::where('active', '1')->orderBy('sort')->get();
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }

        View::share($data);
        Config::set($config);
    }
}
