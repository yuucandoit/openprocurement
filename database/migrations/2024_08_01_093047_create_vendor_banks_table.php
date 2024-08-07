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
        Schema::create('vendor_banks', function (Blueprint $table) {
            $table->id();
            $table->morphs('vendor');
            $table->integer('bank_id')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_penerima')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_banks');
    }
};
