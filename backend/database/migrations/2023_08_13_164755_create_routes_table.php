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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('vehicle_id')->constrained('vehicles');

            $table->boolean('in_progress')->default(false);

            $table->bigInteger('odo_start');
            $table->bigInteger('odo_end');

            $table->timestamp('start_time');
            $table->timestamp('end_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
