<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('subCategory_id')->unsigned()->index();
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')
                ->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->bigInteger('vendor_id')->unsigned()->index();
            $table->foreign('vendor_id')->references('id')->on('vendors')
                ->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->text('name');
            $table->longText('desc')->nullable();
            $table->text('short_desc')->nullable();

            $table->decimal('rate', 10, 1);
            $table->enum('type', ['product', 'service']);
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('stock')->default(0);

            $table->bigInteger('unit_id')->unsigned()->index()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->string('SKU')->unique();

            $table->json('shipping_prices')->nullable();

            $table->tinyInteger('active')->default(1);
            $table->integer('views')->default(0);

            $table->string('slug')->unique();
            $table->text('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->integer('sort');
            $table->boolean('best_seller');

            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
