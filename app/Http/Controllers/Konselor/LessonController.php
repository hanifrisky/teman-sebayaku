<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('creator')->withCount('sections')->latest()->get();
        return view('konselor.lessons.index', compact('lessons'));
    }

    public function create()
    {
        return view('konselor.lessons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'sections' => 'nullable|array',
            'sections.*.type' => 'required|in:text,image,video,youtube,pdf,link',
        ]);

        $lesson = Lesson::create([
            'title' => $request->title,
            'tag' => $request->tag,
            'created_by' => auth()->id(),
        ]);

        if ($request->has('sections')) {
            foreach ($request->sections as $index => $secData) {
                $filePath = null;

                if ($request->hasFile("sections.{$index}.file")) {
                    $file = $request->file("sections.{$index}.file");
                    $type = $secData['type'];
                    $folder = in_array($type, ['image', 'video', 'pdf']) ? "lessons/{$type}" : "lessons/misc";
                    $filePath = $file->store($folder, 'public');
                }

                $lesson->sections()->create([
                    'type' => $secData['type'],
                    'content_text' => $secData['content_text'] ?? null,
                    'link_url' => $secData['link_url'] ?? null,
                    'link_title' => $secData['link_title'] ?? null,
                    'file_path' => $filePath,
                    'order' => $secData['order'] ?? $index,
                ]);
            }
        }

        return redirect()->route('konselor.lessons.index')
            ->with('success', 'Lesson berhasil ditambahkan.');
    }

    public function edit(Lesson $lesson)
    {
        $lesson->load(['sections' => function($q) {
            $q->orderBy('order');
        }]);
        return view('konselor.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'sections' => 'nullable|array',
            'sections.*.type' => 'required|in:text,image,video,youtube,pdf,link',
        ]);

        $lesson->update([
            'title' => $request->title,
            'tag' => $request->tag,
        ]);

        $submittedIds = [];
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $secData) {
                if (!empty($secData['id'])) {
                    $submittedIds[] = $secData['id'];
                }
            }
        }

        // Delete removed sections
        $sectionsToRemove = $lesson->sections()->whereNotIn('id', $submittedIds)->get();
        foreach ($sectionsToRemove as $sec) {
            if ($sec->file_path) {
                Storage::disk('public')->delete($sec->file_path);
            }
            $sec->delete();
        }

        if ($request->has('sections')) {
            foreach ($request->sections as $index => $secData) {
                $filePath = null;
                $existingSection = null;

                if (!empty($secData['id'])) {
                    $existingSection = $lesson->sections()->find($secData['id']);
                }

                if ($existingSection) {
                    $filePath = $existingSection->file_path;
                } elseif (!empty($secData['file_path'])) {
                    $filePath = $secData['file_path'];
                }

                if ($request->hasFile("sections.{$index}.file")) {
                    if ($existingSection && $existingSection->file_path) {
                        Storage::disk('public')->delete($existingSection->file_path);
                    }
                    $file = $request->file("sections.{$index}.file");
                    $type = $secData['type'];
                    $folder = in_array($type, ['image', 'video', 'pdf']) ? "lessons/{$type}" : "lessons/misc";
                    $filePath = $file->store($folder, 'public');
                }

                $data = [
                    'type' => $secData['type'],
                    'content_text' => $secData['content_text'] ?? null,
                    'link_url' => $secData['link_url'] ?? null,
                    'link_title' => $secData['link_title'] ?? null,
                    'file_path' => $filePath,
                    'order' => $secData['order'] ?? $index,
                ];

                if ($existingSection) {
                    $existingSection->update($data);
                } else {
                    $lesson->sections()->create($data);
                }
            }
        }

        return redirect()->route('konselor.lessons.index')
            ->with('success', 'Lesson berhasil diperbarui.');
    }

    public function destroy(Lesson $lesson)
    {
        foreach ($lesson->sections as $sec) {
            if ($sec->file_path) {
                Storage::disk('public')->delete($sec->file_path);
            }
        }
        $lesson->delete();
        return redirect()->route('konselor.lessons.index')
            ->with('success', 'Lesson berhasil dihapus.');
    }
}
