<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ship_goods_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
          //  $table->bigInteger('trip_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('section_end_id')->unsigned();
            $table->bigInteger('weight');
            $table->integer('quantity');
            $table->text('description');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          //  $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_end_id')->references('id')->on('section')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_goods_request');
    }
};
