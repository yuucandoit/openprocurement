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
            $table->string('status')->default('Awaiting Purchase Submission Approval')->nullable();
            $table->foreignId('atasan')->constrained('users');
            $table->foreignId('ws')->constrained('who_submitted'); //Who Submitted(ws)
            $table->foreignId('department')->constrained('department');
            $table->string('category_purpose');
            $table->morphs('purpose');
            $table->date('date_ps');
            $table->text('desc');
            $table->enum('matauang',['USD','RP']);
            $table->string('send_to');
            $table->enum('dateline',['≤3Jam','≤24Jam','≤2Hari','SesuaiPo']);
            $table->time('dateline_time')->nullable();
            $table->boolean('ppn')->nullable()->default(false);
            $table->string('image')->nullable();
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
