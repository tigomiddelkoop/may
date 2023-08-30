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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->softDeletesDatetime();
        });

        Schema::table('fuels', function (Blueprint $table) {
            $table->softDeletesDatetime();
        });

        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->softDeletesDatetime();
        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->softDeletesDatetime();
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('fuels', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('fuel_expenses', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('activity_expenses', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
