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
            $table->softDeletes();
        });
        Schema::table('category_pengajuan_pembelian', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('item_po', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('po_signatures', function (Blueprint $table) {
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
        Schema::table('_p_r__p_o', function (Blueprint $table) {
            //
        });
    }
};
