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
        Schema::create('coleccion__elementos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coleccion_id');
            $table->unsignedInteger('elemento_id');
            $table->foreign('coleccion_id')->references('id')->on('coleccions');
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion__elementos');
    }
};
