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
            // MOD-09: catatan evaluasi dari creator untuk anggota tim
            $table->text('catatan_evaluasi')->nullable()->after('nilai_evaluasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_member', function (Blueprint $table) {
            $table->dropColumn('catatan_evaluasi');
        });
    }
};
