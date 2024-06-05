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
        Schema::table('category_pengajuan_pembelian', function (Blueprint $table) {
            $table->boolean('logistic_check')->after('id')->default(0);
            $table->text('note_logistic')->after('note_finance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_pengajuan_pembelian', function (Blueprint $table) {
            //
        });
    }
};
