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
        Schema::create('category_pd', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default('0');
            $table->string('subject');
            $table->string('name');
            $table->string('tujuan');
            $table->string('lokasi');
            $table->date('jangka_waktu');
            $table->bigInteger('nominal');
            $table->bigInteger('no_rek');
            $table->string('status')->default('pending')->nullable();
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
        Schema::dropIfExists('category_pd');
    }
};
