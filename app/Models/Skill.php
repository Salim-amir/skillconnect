<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['nama_skill'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skill')
                    ->withPivot('id', 'tingkat_keahlian')
                    ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_skill')
                    ->withTimestamps();
    }
}
