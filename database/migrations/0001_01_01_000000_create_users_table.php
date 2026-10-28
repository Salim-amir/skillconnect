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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // PK otomatis
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable(); // Dibuat nullable untuk pendaftaran via Google SSO
            $table->string('role')->default('member'); // Nilai default 'member', menerima 'creator' / 'admin'
            $table->string('google_id')->nullable(); // Ditambahkan untuk menyimpan ID Google SSO
            $table->text('pengalaman')->nullable();
            $table->string('portofolio')->nullable();
            $table->string('cv_path')->nullable(); // Sesuai dengan $fillable di User.php
            $table->rememberToken(); // Diperlukan untuk sesi login Laravel
            $table->timestamps(); 
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};