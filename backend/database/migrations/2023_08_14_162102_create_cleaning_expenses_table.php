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
        Schema::create('cleaning_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('vehicle_id')->index()->constrained('vehicles');
            $table->foreignUuid('cleaning_category_id')->index()->constrained('cleaning_categories');
            $table->foreignUuid('location_id')->constrained('locations')->nullable();

            $table->decimal('price');
            $table->bigInteger('odometer');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleanings');
    }
};
