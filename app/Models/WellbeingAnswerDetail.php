<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WellbeingAnswerDetail extends Model
{
    protected $fillable = [
        'wellbeing_answer_id',
        'question_id',
        'selected_option_id',
        'score',
    ];

    public function wellbeingAnswer(): BelongsTo
    {
        return $this->belongsTo(WellbeingAnswer::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(OptionItem::class, 'selected_option_id');
    }
}
