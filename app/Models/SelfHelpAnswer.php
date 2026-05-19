<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelfHelpAnswer extends Model
{
    protected $fillable = [
        'konseli_id',
        'material_question_id',
        'answer_text',
    ];

    public function konseli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }

    public function materialQuestion(): BelongsTo
    {
        return $this->belongsTo(MaterialQuestion::class);
    }
}
