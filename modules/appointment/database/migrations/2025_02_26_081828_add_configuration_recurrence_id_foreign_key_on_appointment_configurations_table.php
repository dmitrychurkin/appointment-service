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
        Schema::table('appointment_configurations', function (Blueprint $table) {
            $table->foreignUuid('configuration_recurrence_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_configurations', function (Blueprint $table) {
            $table->dropForeign(['configuration_recurrence_id']);
            $table->dropColumn('configuration_recurrence_id');
        });
    }
};
