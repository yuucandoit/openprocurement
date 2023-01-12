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
        Schema::create('pengajuan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('ppb_id')->default('0');
            $table->string('path_file')->nullable();
            $table->text('item');
            $table->bigInteger('qty');
            $table->enum('kategori', ['Pcs', 'Lusin', 'Box', 'Unit']);
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('grand_total')->nullable();
            $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('pengajuan_pembelians');
    }
};
