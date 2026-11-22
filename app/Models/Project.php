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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function latestTransaction()
    {
        return $this->hasOne(Transaction::class)->latestOfMany();
    }

    /**
     * Menghitung statistik tugas proyek berdasarkan status task.
     *
     * @return array<string, int|float>
     */
    public function getTaskStatistics(): array
    {
        $total = $this->tasks()->count();
        $done = $this->tasks()->where('status_task', 'Selesai')->count();
        $inProgress = $this->tasks()->where('status_task', 'Sedang Dikerjakan')->count();
        $todo = $this->tasks()->where('status_task', 'Belum Dikerjakan')->count();
        $review = $this->tasks()->where('status_task', 'Menunggu Review')->count();
        $percentage = $total > 0 ? round(($done / $total) * 100, 1) : 0.0;

        return [
            'total' => $total,
            'done' => $done,
            'in_progress' => $inProgress,
            'todo' => $todo,
            'review' => $review,
            'percentage' => $percentage,
        ];
    }

    /**
     * Menghitung persentase progres proyek berdasarkan task yang selesai.
     */
    public function calculateProgress(): float
    {
        $total = $this->tasks()->count();
        if ($total === 0) {
            return 0.0;
        }

        $done = $this->tasks()->where('status_task', 'Selesai')->count();

        return round(($done / $total) * 100, 1);
    }
}
