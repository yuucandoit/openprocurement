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
        Schema::table('part_item__pre_prs', function (Blueprint $table) {
            $table->boolean('is_check')->default(0)->after('pre_pr_id');
            $table->string('type_product')->nullable()->after('child_item');
            $table->text('notes')->nullable()->after('creator_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('part_item__pre_prs', function (Blueprint $table) {
            //
        });
    }
};
