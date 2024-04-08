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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('set null');
            $table->string('model');
            $table->string('color');
            $table->year('year');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('mileage');
            $table->string('transmission_type');
            $table->string('fuel_type');
            $table->string('engine_size');
            $table->unsignedInteger('number_of_seats');
            $table->string('body_type');
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
