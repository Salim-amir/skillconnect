<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'jumlah_fee',
        'order_id',
        'snap_token',
        'status_pembayaran',
    ];

    protected $casts = [
        'jumlah_fee' => 'decimal:2',
    ];

    /**
     * Relasi ke Proyek yang dibayar
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi ke User pembayar (Creator)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
