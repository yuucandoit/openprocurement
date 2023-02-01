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
            $table->text('item');
            $table->bigInteger('qty');
            $table->enum('kategori', ['Pcs', 'Lusin', 'Box', 'Unit']);
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->boolean('ppn')->nullable()->default(false);
            $table->bigInteger('grand_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_po', function (Blueprint $table) {
            //
        });
    }
};
