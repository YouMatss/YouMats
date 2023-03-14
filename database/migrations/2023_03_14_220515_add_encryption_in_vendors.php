<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEncryptionInVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->after('manage_by_admin', function (Blueprint $t) {
                $t->boolean('enable_encryption_mode')->default(1);
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
        Schema::table('vendor', function (Blueprint $table) {
            //
        });
    }
}
