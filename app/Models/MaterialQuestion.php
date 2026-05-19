<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialQuestion extends Model
{
    protected $fillable = ['material_id', 'category', 'text', 'order'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SelfHelpAnswer::class);
    }
}
