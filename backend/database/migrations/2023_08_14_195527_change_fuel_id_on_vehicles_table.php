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
        Schema::dropColumns('vehicles', ['fuel_id']);

        Schema::table('vehicles', function (Blueprint $table) {
            $table->uuid('fuel_category_id')->constrained('fuel_categories')->nullable()->after('engine_type');
            $table->uuid('default_fuel_id')->constrained('fuels')->nullable()->after('fuel_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('vehicles', ['fuel_category_id', 'default_fuel_id']);

        Schema::table('vehicles', function (Blueprint $table) {
            $table->uuid('fuel_id')->nullable();
        });
    }
};
