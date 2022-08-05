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
        Schema::create('category_pengajuan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('pt_id')->default('0');
            $table->integer('po_id')->default('0');
            $table->integer('user_id')->default('0');
            $table->string('status')->default('pending')->nullable();
            $table->date('date_ps');
            $table->enum('ws', ['GA', 'Purchasing']); //Who Submitted(ws)
            $table->string('item');
            $table->string('qty');
            $table->string('ref');
            $table->string('desc');
            $table->string('purpose');
            $table->string('priceperunit');
            $table->string('send_to');
            $table->string('date_send');
            $table->string('proposed_supplier');
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
        Schema::dropIfExists('category_pengajuan_pembelians');
    }
};
