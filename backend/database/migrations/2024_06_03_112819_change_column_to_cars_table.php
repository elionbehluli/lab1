<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['brand_id']);

            // Modify brand_id column to allow null values
            $table->unsignedBigInteger('brand_id')->nullable()->change();

            // Add new foreign key constraint with 'set null' on delete
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }
     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
        });
    }
};
