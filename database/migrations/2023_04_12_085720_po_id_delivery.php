<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->integer('po_id')->nullable();
        });
        Schema::table('delivery_tracks', function (Blueprint $table) {
            $table->integer('po_id')->nullable();
        });
        Schema::table('category_pd', function (Blueprint $table) {
            $table->integer('po_id')->nullable();
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
};
