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
        Schema::table('cleaning_expenses', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['cleaning_category_id']);
            $table->dropForeign(['location_id']);

            $table->dropIfExists();
        });

        Schema::table('repair_expenses', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['repair_category_id']);
            $table->dropForeign(['location_id']);

            $table->dropIfExists();
        });

        Schema::dropIfExists('cleaning_categories');
        Schema::dropIfExists('repair_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('repair_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');

            $table->timestamps();
        });

        Schema::create('cleaning_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');

            $table->timestamps();
        });

        Schema::create('cleaning_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('vehicle_id')->index()->constrained('vehicles');
            $table->foreignId('cleaning_category_id')->index()->constrained('cleaning_categories');
            $table->foreignId('location_id')->constrained('locations')->nullable();

            $table->decimal('price');
            $table->bigInteger('odometer');

            $table->text('note')->nullable();

            $table->timestamps();
        });

        Schema::create('repair_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('vehicle_id')->index()->constrained('vehicles');
            $table->foreignId('repair_category_id')->index()->constrained('repair_categories');
            $table->foreignId('location_id')->constrained('locations')->nullable();

            $table->decimal('price');
            $table->bigInteger('odometer');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }
};
