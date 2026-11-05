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
            // Cek apakah kolom remember_token belum ada sebelum menambahkan
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom remember_token ada sebelum menghapusnya
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropRememberToken();
            }
        });
    }
};