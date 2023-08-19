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
            $table->integer('engine_type_id')->nullable()->constrained('engine_types');
            $table->integer('vehicle_type_id')->nullable()->constrained('vehicle_types');
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
