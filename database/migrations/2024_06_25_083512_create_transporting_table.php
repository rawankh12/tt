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
        Schema::create('transporting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('type_tra_id')->unsigned();
            $table->integer('capacity');
            $table->integer('number');
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_tra_id')->references('id')->on('type_transporting')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporting');
    }
};
