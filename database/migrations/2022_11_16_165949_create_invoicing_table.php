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
        Schema::create('invoicing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppb_id')->constrained('category_pengajuan_pembelian')->onDelete('cascade');
            // $table->string('path_image')->nullable();
            $table->string('signature')->nullable();
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('invoicing');
    }
};
