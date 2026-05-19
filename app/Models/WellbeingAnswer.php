<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WellbeingAnswer extends Model
{
    protected $fillable = [
        'konseli_id',
        'type',
        'konseli_name',
        'status',
        'total_score',
        'interpretation_id',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function konseli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }

    public function interpretation(): BelongsTo
    {
        return $this->belongsTo(Interpretation::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(WellbeingAnswerDetail::class);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
