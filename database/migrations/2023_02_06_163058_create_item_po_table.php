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
        Schema::create('item_po', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('po_id')->nullable();
            $table->text('item');
            $table->bigInteger('qty');
            $table->enum('kategori', ['Pcs', 'Lusin', 'Box','Unit','Lot','Rim','Org','Line','Ruang','Pax','Set','Piece','Rol','Pack','Batang']);
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('dpp')->nullable();
            $table->bigInteger('ongkir')->default(0)->nullable();
            $table->enum('matauang',['USD','RP']);
            $table->boolean('ppn')->nullable()->default(false);
            $table->bigInteger('grand_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_p_o_s');
    }
};
