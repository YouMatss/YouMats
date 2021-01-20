<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('membership_id')->unsigned()->index();
            $table->foreign('membership_id')->references('id')->on('memberships')
                ->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->bigInteger('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->string('name');
            $table->string('email')->unique();

            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp_phone')->nullable();

            $table->string('address')->nullable();
            $table->string('address2')->nullable();

            $table->text('location')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('website_url')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('vendors');
    }
}
