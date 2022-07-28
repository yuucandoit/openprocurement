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
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('po_id')->default(0);
            $table->string('keterangan');
            $table->bigInteger('qty');
            $table->enum('unit', ['Pcs', 'Lusin', 'Box', 'Unit']);
            $table->bigInteger('unit_price');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('purchase_order');
    }
};
