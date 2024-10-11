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
            $table->string('type_pr')->default('standard')->after('signature');
            $table->string('file_spk')->nullable()->after('type_pr');
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
