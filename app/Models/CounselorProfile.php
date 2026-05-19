<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'motto',
        'photo_path',
        'whatsapp_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp_number ?? '');
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }
        return "https://wa.me/{$number}";
    }
}
