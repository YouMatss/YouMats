<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->after('short_desc', function($table) {
                $table->bigInteger('shipping_id')->unsigned()->index()->nullable();
                $table->foreign('shipping_id')->references('id')->on('shippings')
                    ->onDelete('CASCADE')->onUpdate('CASCADE');
            });
        });
        Schema::table('products', function (Blueprint $table) {
            $table->after('views', function($table) {
                $table->bigInteger('shipping_id')->unsigned()->index()->nullable();
                $table->foreign('shipping_id')->references('id')->on('shippings')
                    ->onDelete('CASCADE')->onUpdate('CASCADE');
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
        //
    }
}
