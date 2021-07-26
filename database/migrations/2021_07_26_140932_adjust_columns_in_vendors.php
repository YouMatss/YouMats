<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustColumnsInVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('phone','phone2','whatsapp_phone','address2', 'address');

            $table->after('name', function($table) {
               $table->text('person_name');
               $table->text('emails');
               $table->text('phones');
               $table->text('addresses');
               $table->text('job');
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
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
}
