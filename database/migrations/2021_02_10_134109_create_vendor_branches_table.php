<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');

            $table->bigInteger('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->string('name');
            $table->string('phone_number');
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_branches');
    }
}
