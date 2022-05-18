<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpToField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->after('default_price', function (Blueprint $t) {
                $t->integer('default_upTo')->nullable();
            });
        });
        Schema::table('products', function (Blueprint $table) {
            $table->after('default_price', function (Blueprint $t) {
                $t->integer('default_upTo')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field', function (Blueprint $table) {
            //
        });
    }
}
