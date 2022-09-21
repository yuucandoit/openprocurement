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
        Schema::create('category_po', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->foreignId('ppb_id')->constrained('category_pengajuan_pembelian')->onDelete('cascade');
            $table->foreignId('atasan_po')->constrained('users');
            $table->foreignId('pt_id')->nullable()->constrained('category_pt');
            $table->foreignId('op_id')->nullable()->constrained('category_pp');
            $table->foreignId('ec_id')->nullable()->constrained('category_ecommerce');
            $table->string('vendor')->nullable();
            // $table->string('name');
            $table->string('address');
            $table->string('no_telp');
            $table->string('no_npwp');
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
        Schema::dropIfExists('category_po');
    }
};
