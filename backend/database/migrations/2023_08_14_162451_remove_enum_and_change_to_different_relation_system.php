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
        Schema::dropColumns('fuels', ['type']);

        Schema::table('fuels', function (Blueprint $table) {
            $table->uuid('fuel_category_id')->after('description')->constrained('fuel_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('fuels', ['fuel_category_id']);

        Schema::table('fuels', function (Blueprint $table) {
            $table->enum('type', ['ELECTRIC', 'GASOLINE', 'DIESEL', 'GASEOUS'])->nullable();
        });
    }
};
