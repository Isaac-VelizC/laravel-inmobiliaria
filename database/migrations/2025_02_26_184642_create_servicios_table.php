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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->text('detail')->nullable();
            $table->string('worker', 100)->nullable();
            $table->text('description');
            $table->date('date_start');
            $table->date('date_end');
            $table->decimal('price', 10, 5)->default(0);
            $table->string('status', 50)->default('pendiente');
            $table->unsignedBigInteger('id_solicitud')->nullable();
            $table->foreign('id_solicitud')->references('id')->on('solicitud_servicios')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_servicio');
            $table->foreign('tipo_servicio')->references('id')->on('servicios_tipos')->onDelete('cascade');
            $table->unsignedBigInteger('id_propiedad');
            $table->foreign('id_propiedad')->references('id')->on('propiedades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
