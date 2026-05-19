<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = ['tribe_id', 'title', 'values', 'description', 'order'];

    public function tribe(): BelongsTo
    {
        return $this->belongsTo(Tribe::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(MaterialQuestion::class)->orderBy('order');
    }
}
