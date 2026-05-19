<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tribe extends Model
{
    protected $fillable = ['name'];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class)->orderBy('order');
    }

    public function konseli(): HasMany
    {
        return $this->hasMany(User::class, 'selected_tribe_id');
    }
}
