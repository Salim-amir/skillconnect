<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'nama_task',
        'deadline',
        'status_task',
        'bukti_kerja',
        'link_demo',
        'catatan_revisi',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    /**
     * Relasi: Task milik sebuah Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi: Task ditugaskan ke seorang User (anggota tim)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Riwayat perubahan status task
     */
    public function statusHistories()
    {
        return $this->hasMany(TaskStatusHistory::class)->orderBy('created_at', 'desc');
    }

    /**
     * Relasi: Komentar/diskusi di dalam task
     */
    public function comments()
    {
        return $this->hasMany(TaskComment::class)->orderBy('created_at', 'asc');
    }
}
