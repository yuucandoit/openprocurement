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
        Schema::create('category_pp', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default('0');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nik');
            $table->string('npwp_pp');
            $table->enum('pkp',['PKP','Non-PKP']);
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
        Schema::dropIfExists('category_s_p_s');
    }
};
