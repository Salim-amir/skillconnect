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
}
