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
        // This migration is no longer needed since guru_id was removed from create_absensi_table
        // But keeping it for migration history consistency
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: The gurus table was dropped, so we cannot restore this constraint
    }
};
