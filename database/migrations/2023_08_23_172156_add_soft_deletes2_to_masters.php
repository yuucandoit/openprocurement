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
        Schema::table('office', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('workshop', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('inventory', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('RnD', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('department', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('travel', function (Blueprint $table) {
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masters', function (Blueprint $table) {
            //
        });
    }
};
