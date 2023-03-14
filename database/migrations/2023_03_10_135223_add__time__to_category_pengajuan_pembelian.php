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
            $table->timestamp('check_po_timestamp')->nullable();
            $table->timestamp('w_approval_po_timestamp')->nullable();
            $table->timestamp('w_finance_pay_timestamp')->nullable();
            $table->timestamp('p_finance_timestamp')->nullable();
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
