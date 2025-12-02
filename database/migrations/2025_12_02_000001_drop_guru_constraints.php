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
        // Drop guru_id constraint from kelas table
        Schema::table('kelas', function (Blueprint $table) {
            try {
                $table->dropForeignKey(['guru_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
        });

        // Drop guru_id column from kelas if exists
        Schema::table('kelas', function (Blueprint $table) {
            if (Schema::hasColumn('kelas', 'guru_id')) {
                $table->dropColumn('guru_id');
            }
        });

        // Drop guru_id constraint from absensi table
        Schema::table('absensi', function (Blueprint $table) {
            try {
                $table->dropForeignKey(['guru_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
        });

        // Drop guru_id column from absensi if exists
        Schema::table('absensi', function (Blueprint $table) {
            if (Schema::hasColumn('absensi', 'guru_id')) {
                $table->dropColumn('guru_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: This migration only removes constraints, so reverse is a no-op
        // The gurus table was already dropped in earlier migrations
    }
};
