<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cek dan drop foreign key dari siswas jika ada
        $siswasConstraints = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'siswas' 
            AND COLUMN_NAME = 'kelas_id' 
            AND CONSTRAINT_NAME != 'PRIMARY'
        ");
        
        if (!empty($siswasConstraints)) {
            foreach ($siswasConstraints as $constraint) {
                Schema::table('siswas', function (Blueprint $table) use ($constraint) {
                    $table->dropForeign($constraint->CONSTRAINT_NAME);
                });
            }
        }
        
        // Cek dan drop foreign key dari absensi jika ada
        $absensiConstraints = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'absensi' 
            AND COLUMN_NAME = 'kelas_id' 
            AND CONSTRAINT_NAME != 'PRIMARY'
        ");
        
        if (!empty($absensiConstraints)) {
            foreach ($absensiConstraints as $constraint) {
                Schema::table('absensi', function (Blueprint $table) use ($constraint) {
                    $table->dropForeign($constraint->CONSTRAINT_NAME);
                });
            }
        }
        
        // Tambah foreign key baru dengan cascade
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
        
        Schema::table('absensi', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
        
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }
};