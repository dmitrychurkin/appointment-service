<?php

declare(strict_types=1);

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
        Schema::table('configuration_availability_slots', function (Blueprint $table) {
            $table->unsignedTinyInteger('day_of_week')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuration_availability_slots', function (Blueprint $table) {
            $table->dropColumn('day_of_week');
        });
    }
};
