<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = ['title', 'tag', 'created_by'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(LessonSection::class)->orderBy('order');
    }

    public function getThumbnailAttribute(): string
    {
        $imageSection = $this->sections->where('type', 'image')->first();
        if ($imageSection && $imageSection->file_path) {
            return asset('storage/' . $imageSection->file_path);
        }

        $videoSection = $this->sections->where('type', 'video')->first();
        if ($videoSection && $videoSection->content_text) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|win(?:dows)?|shorts/|watch\?v=|embed/)|youtu\.be/)([^"&?/ ]{11})%i', $videoSection->content_text, $match);
            if (!empty($match[1])) {
                return "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg";
            }
        }

        return asset('image/default-lesson-thumbnail.png');
    }
}
