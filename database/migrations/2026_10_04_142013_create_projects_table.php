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
        Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();
    $table->string('judul_project');
    $table->text('deskripsi');
    $table->string('kategori');
    $table->decimal('budget', 15, 2);
    $table->string('status_project');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
