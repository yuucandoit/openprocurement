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
        Schema::table('category_pt', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('who_submitted', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('referensi_nama_project', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('category_pp', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('category_ecommerce', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('banks', function (Blueprint $table) {
            $table->softDeletes();
        });
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
