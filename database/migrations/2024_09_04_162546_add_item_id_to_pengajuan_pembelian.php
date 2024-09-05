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
        Schema::table('item_po', function (Blueprint $table) {
            $table->integer('pr_item_id')->after('po_id')->nullable();
            $table->integer('prepr_item_id')->after('pr_item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_pembelian', function (Blueprint $table) {
            //
        });
    }
};
