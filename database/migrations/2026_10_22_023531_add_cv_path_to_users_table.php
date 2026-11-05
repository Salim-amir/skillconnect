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
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom cv_path belum ada sebelum menambahkan
            if (!Schema::hasColumn('users', 'cv_path')) {
                $table->string('cv_path')->nullable()->after('pengalaman');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom cv_path ada sebelum menghapus
            if (Schema::hasColumn('users', 'cv_path')) {
                $table->dropColumn('cv_path');
            }
        });
    }
};