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
        Schema::dropColumns('vehicles', ['engine_type', 'vehicle_type']);
        Schema::table('vehicles', function (Blueprint $table) {
            $table->uuid('engine_type_id')->constrained('engine_types')->nullable();
            $table->uuid('vehicle_type_id')->constrained('vehicle_types')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('vehicles', ['engine_type_id', 'vehicle_type_id']);
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('vehicle_type', ['CAR', 'TRUCK', 'MOTOR'])->default('CAR');
            $table->enum('engine_type', ['ELECTRIC', 'COMBUSTION'])->default('COMBUSTION');
        });
    }
};
