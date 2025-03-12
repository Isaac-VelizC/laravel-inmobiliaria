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
        Schema::create('cita_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date')->default(now());
            $table->time('time');
            $table->integer('cantidad')->default(1);
            $table->string('status', 50)->default('pendiente');
            $table->text('detail')->nullable();
            $table->unsignedBigInteger('propiedad');
            $table->foreign('propiedad')->references('id')->on('propiedades')->onDelete('cascade');
            $table->unsignedBigInteger('agente');
            $table->foreign('agente')->references('id')->on('agentes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_groups');
    }
};
