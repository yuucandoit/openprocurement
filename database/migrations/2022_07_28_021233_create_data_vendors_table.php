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
        Schema::create('data_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('npwp');
            $table->string('nama');
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('email');
            $table->enum('Pkp', ['PKP', 'Non-PKP']);
            $table->string('jenis_usaha');
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
        Schema::dropIfExists('data_vendors');
    }
};
