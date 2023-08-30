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
            $table->dateTime('expense_time');
        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->dateTime('expense_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->dropColumn('expense_time');
        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->dropColumn('expense_time');
        });
    }
};
