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
        Schema::table('category_po', function (Blueprint $table) {
            $table->string('code_po')->nullable();
        });
        Schema::table('category_pengajuan_pembelian', function (Blueprint $table) {
            $table->string('code_pengajuan')->nullable();
        });
        Schema::table('invoicing', function (Blueprint $table) {
            $table->string('code_pd')->nullable();
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
