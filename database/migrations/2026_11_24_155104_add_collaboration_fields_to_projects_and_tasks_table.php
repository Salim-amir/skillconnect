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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('github_url')->nullable()->after('budget');
            $table->string('figma_url')->nullable()->after('github_url');
            $table->string('demo_url')->nullable()->after('figma_url');
            $table->string('docs_url')->nullable()->after('demo_url');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->string('link_demo')->nullable()->after('bukti_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['github_url', 'figma_url', 'demo_url', 'docs_url']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['link_demo']);
        });
    }
};
