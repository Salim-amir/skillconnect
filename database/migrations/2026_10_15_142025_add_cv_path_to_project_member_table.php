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
        Schema::table('project_member', function (Blueprint $table) {
            // CV pelamar — wajib, hanya format PDF, maks 2MB
            $table->string('cv_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_member', function (Blueprint $table) {
            $table->dropColumn('cv_path');
        });
    }
};
