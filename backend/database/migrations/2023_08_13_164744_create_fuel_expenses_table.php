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
        Schema::create('fuel_expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fuel_id')->constrained('fuels');;
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('location_id')->constrained('locations')->nullable();

            $table->decimal('amount');
            $table->decimal('price');
            $table->bigInteger('odometer');
            $table->boolean('filled_up');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
