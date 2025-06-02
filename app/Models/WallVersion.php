<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class WallVersion extends Model
{
    /** @use HasFactory<\Database\Factories\WallVersionFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'wall_id',
        'version',
        'design_json',
        'published_at',
    ];

    protected $casts = [
        'design_json' => 'array',
        'published_at' => 'datetime',
        'version' => 'integer',
    ];
    // set the primary key type to string (UUID)
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // --- RELATIONS ---
    // freedom_wall has many versions
    public function freedomWall(): belongsTo
    {
        return $this->belongsTo(FreedomWall::class, 'wall_id', 'id');
    }
    


    // --- UTILITIES ---
    // get the latest version of the freedom wall
    public function getLatestVersion(): ?WallVersion
    {
        return $this->freedomWall->versions()->latest()->first();
    }

    public function getOldestVersion(): ?WallVersion
    {
        return $this->freedomWall->versions()->oldest()->first();
    }

    public function scopeLatestVersion($query)
    {
        return $query->latest()->first();
    }

    public function scopeOldestVersion($query)
    {
        return $query->oldest()->first();
    }
}
