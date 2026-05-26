<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::with('creator')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tag', 'like', "%{$search}%");
            });
        }

        $lessons = $query->paginate(12);

        return view('konseli.lessons.index', compact('lessons'));
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['sections' => function($q) {
            $q->orderBy('order');
        }, 'creator']);

        return view('konseli.lessons.show', compact('lesson'));
    }
}
