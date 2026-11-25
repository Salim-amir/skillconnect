<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'pesan',
        'file_path',
        'file_name',
    ];

    /**
     * Relasi ke Proyek
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi ke User pengirim pesan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
