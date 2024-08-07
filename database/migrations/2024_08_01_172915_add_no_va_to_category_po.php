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
        Schema::table('category_po', function (Blueprint $table) {
            $table->enum('payment_type', ['Bank','Va'])->after('path_invoice')->nullable();
            $table->integer('id_vendor_bank')->nullable();
            $table->string('no_rekening')->after('payment_type')->nullable();
            $table->string('va_code')->after('no_rekening')->nullable();
            $table->timestamp('payment_date')->after('va_code')->nullable();
            $table->string('payment_purpose')->after('payment_date')->nullable();
            $table->string('nilai')->after('payment_purpose')->nullable();
            $table->boolean('ket_pajak')->after('nilai')->nullable();
            $table->timestamp('rejected_at')->after('approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_po', function (Blueprint $table) {
            //
        });
    }
};
