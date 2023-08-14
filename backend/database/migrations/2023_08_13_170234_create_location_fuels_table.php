<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuel_location', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('location_id')->constrained('locations');
            $table->bigInteger('fuel_id')->constrained('fuels');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_fuels');
    }
};
