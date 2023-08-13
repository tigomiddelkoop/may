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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fuel_id');
            $table->foreignId('vehicle_id');
            $table->foreignId('location_id')->nullable();

            $table->decimal('amount');
            $table->decimal('fuel_price');
            $table->bigInteger('odometer');
            $table->boolean('filled_up');

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
