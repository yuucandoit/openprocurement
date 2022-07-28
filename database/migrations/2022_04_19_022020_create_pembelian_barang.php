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
        Schema::create('pembelian_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default('0');
            $table->string('role_id')->default('0');
            $table->string('status')->default('pending')->nullable();
            $table->integer('pb_id')->default(0);
            // $table->string('no_doc');
            // $table->string('revisi');
            // $table->date('tanggal')->useCurrent();
            $table->integer('rev');
            $table->string('subject');
            $table->string('nama');
            $table->string('lokasi');
            $table->date('jangka_waktu');
            // $table->date('jam_approve');
            $table->string('dana_diperlukan');
            $table->string('no_rek');
            $table->string('item');
            $table->enum('quantity', ['Pcs', 'Lusin', 'Box', 'Unit']);
            $table->bigInteger('jumlah_quantity');
            $table->bigInteger('harga_satuan')->nullable();
            $table->bigInteger('total')->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_barang');
    }
};
