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
        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->renameColumn('odometer', 'odo_reading');
            $table->renameColumn('price', 'activity_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->renameColumn('odo_reading', 'odometer');
            $table->renameColumn('activity_price', 'price');

        });
    }
};
