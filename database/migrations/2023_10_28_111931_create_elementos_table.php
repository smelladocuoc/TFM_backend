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
        Schema::create('elementos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255);
            $table->string('imagen');
            $table->dateTime('fecha_publicacion');
            $table->longText('comentario');
            $table->boolean('adquirido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos');
    }
};
