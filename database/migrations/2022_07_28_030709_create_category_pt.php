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
        Schema::create('category_pt', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default('0');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telp_kantor');
            $table->string('website');
            $table->string('nama_pic');
            $table->string('no_telp_pic');
            $table->string('email');
            $table->string('npwp_perusahaan');
            $table->enum('Pkp', ['PKP', 'Non-PKP']);
            $table->string('nib');
            $table->string('bidang_usaha');
            $table->string('no_rekening');
            $table->enum('bank',['BCA(014)','Mandiri(008)','BNI(009)','BRI(002)', 'BTN(200)','Danamon(011)', 'Permata(013)', 'Maybank(016)']);
            $table->string('nama_penerima');
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
        Schema::dropIfExists('category_d_v_s');
    }
};
