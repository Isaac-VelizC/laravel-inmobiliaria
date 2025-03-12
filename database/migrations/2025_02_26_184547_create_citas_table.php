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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->datetime('date')->default(now());
            $table->time('time');
            $table->string('status', 50)->default('pendiente');
            $table->text('detail')->nullable();
            $table->unsignedBigInteger('propiedad');
            $table->foreign('propiedad')->references('id')->on('propiedades')->onDelete('cascade');
            $table->unsignedBigInteger('usuario');
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
