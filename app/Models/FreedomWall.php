<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class FreedomWall extends Model
{
    /** @use HasFactory<\Database\Factories\FreedomWallFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'design_json',
        'tags',
        'is_public',
        'version',
        'user_id',
    ];

    protected $casts = [
        'design_json' => 'array',
        'tags' => 'array',
        'is_public' => 'boolean',
        'version' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    // 
    public static function safeCreate(array $data = []): self
    {
        try {
            return self::create($data);
        } catch (\Exception $e) {
            Log::error('FreedomWall::safeCreate failed', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            // return empty instance or handle error as needed
            return new self();
        }
    }
    // --- RELATIONS ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // get all versions of the freedom wall
    public function versions()
    {
        return $this->hasMany(WallVersion::class, 'wall_id', 'id');
    }
}
