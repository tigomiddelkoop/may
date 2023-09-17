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
        Schema::create('activity_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('vehicle_id')->index()->constrained('vehicles')->onDelete('cascade');
            $table->uuid('activity_category_id')->index()->constrained('activity_categories')->onDelete('cascade');
            $table->uuid('location_id')->constrained('locations')->nullable()->onDelete('cascade');

            $table->decimal('price');
            $table->bigInteger('odometer')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_expenses');
    }
};
