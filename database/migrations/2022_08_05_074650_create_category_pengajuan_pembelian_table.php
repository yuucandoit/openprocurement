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
            $table->integer('user_id')->default('0');
            $table->string('status')->default('pending')->nullable();
            $table->date('date_ps');
            $table->string('ws'); //Who Submitted(ws)
            $table->string('item');
            $table->string('qty');
            $table->string('desc');
            $table->string('purpose');
            $table->string('priceperunit');
            $table->string('send_to');
            $table->enum('dateline',['Urgent','≤3Jam','≤24Jam','≤2Hari','SesuaiPo']);
            $table->enum('proposed_supplier',['Perusahaan','OrangPribadi','Ecommerce','Unknown']);
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
