<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'judul_project',
        'deskripsi',
        'kategori',
        'budget',
        'status_project',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skill')
            ->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_member')
            ->withPivot('id', 'peran', 'nominal_fee', 'status_keanggotaan', 'nilai_evaluasi')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function calculateProgress(): float
    {
        $total = $this->tasks()->count();
        if ($total === 0) {
            return 0.0;
        }
        $completed = $this->tasks()->where('status_task', 'Selesai')->count();

        return round(($completed / $total) * 100, 2);
    }

    public function getTaskStatistics(): array
    {
        $total = $this->tasks()->count();
        $todo = $this->tasks()->where('status_task', 'Belum Dikerjakan')->count();
        $inProgress = $this->tasks()->where('status_task', 'Sedang Dikerjakan')->count();
        $review = $this->tasks()->where('status_task', 'Menunggu Review')->count();
        $done = $this->tasks()->where('status_task', 'Selesai')->count();

        return [
            'total' => $total,
            'todo' => $todo,
            'in_progress' => $inProgress,
            'review' => $review,
            'done' => $done,
            'percentage' => $this->calculateProgress(),
        ];
    }
}
