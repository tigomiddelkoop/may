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
            $table->renameColumn('amount', 'fuel_quantity');
            $table->renameColumn('price', 'fuel_price');
            $table->renameColumn('odometer', 'odo_reading');
            $table->decimal('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->renameColumn('fuel_quantity', 'amount');
            $table->renameColumn('fuel_price', 'price');
            $table->renameColumn('odo_reading', 'odometer');
            $table->dropColumn('total_price');
        });
    }
};
