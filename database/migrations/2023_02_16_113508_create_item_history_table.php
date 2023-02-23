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
        Schema::create('item_history', function (Blueprint $table) {
            $table->id();
            $table->text('item');
            $table->bigInteger('qty');
            $table->enum('kategori', ['Pcs', 'Lusin', 'Box','Unit','Lot','Rim','Org','Line','Ruang','Pax','Set','Piece','Rol','Pack','Batang']);
            $table->decimal('unit_price', 16,2)->nullable();
            $table->decimal('total',16,2)->nullable();
            $table->decimal('discount',16,2)->nullable();
            $table->decimal('dpp',16,2)->nullable();
            $table->decimal('ongkir',16,2)->default(0)->nullable();
            $table->decimal('admin_fee',16, 2)->after('ongkir')->default(0)->nullable();
            $table->enum('matauang',['USD','RP']);
            $table->boolean('ppn')->nullable()->default(false);
            $table->decimal('grand_total',16,2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('item_histories');
    }
};
