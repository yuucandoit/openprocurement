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
        Schema::create('part_item__pre_prs', function (Blueprint $table) {
            $table->id();
            $table->integer('pre_pr_id')->nullable();
            $table->string('parent_item')->nullable();
            $table->string('child_item')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('buffer')->nullable();
            $table->bigInteger('total')->nullable();
            $table->text('desc')->nullable();
            $table->string('link')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_item__pre_prs');
    }
};
