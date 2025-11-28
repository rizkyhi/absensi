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
        Schema::table('kelas', function (Blueprint $table) {
            try {
                $table->dropForeignKey('kelas_guru_id_foreign');
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
            if (Schema::hasColumn('kelas', 'guru_id')) {
                $table->dropColumn('guru_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('cascade');
        });
    }
};
