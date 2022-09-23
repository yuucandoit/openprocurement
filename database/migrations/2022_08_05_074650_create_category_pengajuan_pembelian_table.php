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
            $table->foreignId('atasan')->constrained('users');
            $table->date('date_ps');
            $table->string('ws'); //Who Submitted(ws)
            $table->enum('department',['R&D','Production','Support_Workshop','Project','Business_Development','Product','Finance','Tax','Human_Resource','Purchasing','GA','Legal', 'Programmer']);
            $table->text('desc');
            $table->foreignId('purpose')->constrained('referensi_nama_project');
            $table->enum('matauang',['USD','RP']);
            $table->string('send_to');
            $table->enum('dateline',['≤3Jam','≤24Jam','≤2Hari','SesuaiPo']);
            $table->time('dateline_time')->nullable();
            $table->enum('proposed_supplier',['Perusahaan','OrangPribadi','Ecommerce','Unknown']);
            $table->boolean('ppn')->nullable()->default(false);
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
