<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingBindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_bindings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('shipping_id')->on('shippings')->references('id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('city_id')->on('cities')->references('id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_bindings');
    }
}
