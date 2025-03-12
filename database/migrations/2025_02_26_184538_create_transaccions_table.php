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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('price', 12, 2);
            $table->unsignedBigInteger('propiedad');
            $table->foreign('propiedad')->references('id')->on('propiedades')->onDelete('cascade');
            $table->unsignedBigInteger('comprador');
            $table->foreign('comprador')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('vendedor');
            $table->foreign('vendedor')->references('id')->on('agentes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
