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
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('address', 200);
            $table->string('city', 50);
            $table->string('country', 50)->default('Bolivia');
            $table->string('zip_code', 10)->default('0000');
            $table->unsignedBigInteger('tipo_propiedad')->nullable();
            $table->foreign('tipo_propiedad')->references('id')->on('tipo_propiedad')->onDelete('set null');
            $table->unsignedBigInteger('tipo_traspaso')->nullable();
            $table->foreign('tipo_traspaso')->references('id')->on('tipo_traspasos')->onDelete('set null');
            $table->integer('num_rooms')->default(0);
            $table->integer('num_bedrooms')->default(0);
            $table->integer('num_bathrooms')->default(0);
            $table->integer('num_hall')->default(0);
            $table->integer('num_kitchens')->default(0);
            $table->integer('num_garages')->default(0);
            $table->decimal('constructed_area', 10, 2);
            $table->decimal('ground_surface', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('coin', 3)->default('USD');
            $table->enum('bank_financing', ['Si', 'No'])->default('No');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('status', 50);
            $table->string('state_advertising', 20)->default('no');
            $table->unsignedBigInteger('propietario')->nullable();
            $table->foreign('propietario')->references('id')->on('propietarios')->onDelete('set null');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};
