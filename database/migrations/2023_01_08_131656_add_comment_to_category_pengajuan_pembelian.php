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
            $table->text('note_bod_pr')->nullable();
            $table->text('note_bod_po')->nullable();
            $table->text('note_bod_py')->nullable();
            $table->text('note_purchase')->nullable();
            $table->text('note_finance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {
            // $table->timestamp('approved_at')->nullable();
        });
    }
};
