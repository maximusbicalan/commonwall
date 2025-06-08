<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WallPost extends Model
{
    /** @use HasFactory<\Database\Factories\WallPostFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'wall_id',
        'user_id',
        'content',
        'created_at',
    ];
    protected $casts = [
        'content' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
    // --- RELATIONS ---
    public function wall()
    {
        return $this->belongsTo(FreedomWall::class, 'wall_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
