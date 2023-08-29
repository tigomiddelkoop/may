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
        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->decimal('fuel_price', 12, 4)->change();
            $table->decimal('fuel_quantity', 12, 4)->change();
            $table->decimal('total_price', 12, 4)->change();
        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->decimal('activity_price', 12, 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->decimal('fuel_price')->change();
            $table->decimal('fuel_quantity')->change();
            $table->decimal('total_price')->change();

        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->decimal('activity_price')->change();
        });
    }
};
