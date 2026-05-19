<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'selected_counselor_id',
        'selected_tribe_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // === Role helpers ===
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isKonselor(): bool
    {
        return $this->role === 'konselor';
    }

    public function isKonseli(): bool
    {
        return $this->role === 'konseli';
    }

    // === Relationships ===

    /** Konselor profile (only for konselor users) */
    public function counselorProfile(): HasOne
    {
        return $this->hasOne(CounselorProfile::class);
    }

    /** The konselor chosen by this konseli */
    public function selectedCounselor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'selected_counselor_id');
    }

    /** The tribe chosen by this konseli */
    public function selectedTribe(): BelongsTo
    {
        return $this->belongsTo(Tribe::class, 'selected_tribe_id');
    }

    /** Konseli users who chose this konselor */
    public function konseliList(): HasMany
    {
        return $this->hasMany(User::class, 'selected_counselor_id');
    }

    /** Wellbeing answers submitted by this konseli */
    public function wellbeingAnswers(): HasMany
    {
        return $this->hasMany(WellbeingAnswer::class, 'konseli_id');
    }

    /** Self-help answers submitted by this konseli */
    public function selfHelpAnswers(): HasMany
    {
        return $this->hasMany(SelfHelpAnswer::class, 'konseli_id');
    }
}
