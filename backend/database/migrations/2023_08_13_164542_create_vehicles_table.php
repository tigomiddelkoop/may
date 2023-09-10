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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('license_plate');
            $table->string('license_plate_country')->nullable();

            $table->string('make');
            $table->string('model');

            $table->string('vin_number')->nullable();

            $table->foreignUuid('fuel_id')->nullable();

            $table->enum('vehicle_type', ['CAR', 'TRUCK', 'MOTOR'])->default('CAR');
            $table->enum('engine_type', ['ELECTRIC', 'COMBUSTION'])->default('COMBUSTION');

            $table->bigInteger('initial_kilometers')->default(0);
            $table->bigInteger('added_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
