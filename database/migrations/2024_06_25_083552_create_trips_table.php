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
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('transport_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->string('section_end');
            $table->date('date');
            $table->time('time');
            $table->bigInteger('num_seat');
            $table->timestamps();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transport_id')->references('id')->on('transporting')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
