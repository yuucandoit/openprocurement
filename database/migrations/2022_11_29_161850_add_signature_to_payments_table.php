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
        Schema::table('tasklist_atasan_payments', function (Blueprint $table) {
            $table->foreignId('ppb_id')->constrained('category_pengajuan_pembelian')->onDelete('cascade');
            $table->string('signature')->nullable();
            $table->timestamp('approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasklist_atasan_payments', function (Blueprint $table) {
            //
        });
    }
};
