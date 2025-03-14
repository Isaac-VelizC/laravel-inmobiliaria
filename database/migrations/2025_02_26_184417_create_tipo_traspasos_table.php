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
        Schema::create('tipo_propiedad', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('detail', 255)->nullable();
            //$table->timestamps();
        });

        Schema::create('tipo_traspasos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('detail', 255)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_propiedad');
        Schema::dropIfExists('tipo_traspasos');
    }
};
