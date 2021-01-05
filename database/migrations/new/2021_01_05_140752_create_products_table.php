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

            $table->string('name');
            $table->text('desc')->nullable();

            $table->string('img');
            $table->string('img_title')->nullable();
            $table->string('img_alt')->nullable();

            $table->decimal('rate', 10, 1);
            $table->text('price');
            $table->text('gallery');

            $table->string('SKU')->unique();
            $table->integer('stoke');

            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->integer('sort');
            $table->logs('admins.id', true);
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
