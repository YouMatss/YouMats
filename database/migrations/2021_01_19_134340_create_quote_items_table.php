<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('quote_id')->unsigned()->index();
            $table->foreign('quote_id')->references('id')->on('quotes')
                ->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->bigInteger('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->string('SKU');
            $table->tinyInteger('quantity');

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
        Schema::dropIfExists('quote_items');
    }
}
