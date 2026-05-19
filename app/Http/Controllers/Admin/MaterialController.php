<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Tribe;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function create(Tribe $tribe)
    {
        return view('admin.materials.create', compact('tribe'));
    }

    public function store(Request $request, Tribe $tribe)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'values' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'questions' => 'nullable|array',
            'questions.*.category' => 'required|in:W,D,E,P',
            'questions.*.text' => 'required|string',
        ]);

        $material = $tribe->materials()->create([
            'title' => $request->title,
            'values' => $request->values,
            'description' => $request->description,
            'order' => $tribe->materials()->max('order') + 1,
        ]);

        if ($request->has('questions')) {
            foreach ($request->questions as $index => $q) {
                $material->questions()->create([
                    'category' => $q['category'],
                    'text' => $q['text'],
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.tribes.show', $tribe)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Tribe $tribe, Material $material)
    {
        $material->load('questions');
        return view('admin.materials.edit', compact('tribe', 'material'));
    }

    public function update(Request $request, Tribe $tribe, Material $material)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'values' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'questions' => 'nullable|array',
            'questions.*.id' => 'nullable|exists:material_questions,id',
            'questions.*.category' => 'required|in:W,D,E,P',
            'questions.*.text' => 'required|string',
        ]);

        $material->update($request->only('title', 'values', 'description'));

        // Identify kept question IDs to delete others
        $submittedQuestionIds = collect($request->questions)->pluck('id')->filter()->all();
        
        // Delete questions that were removed in the UI
        $material->questions()->whereNotIn('id', $submittedQuestionIds)->delete();

        // Create or update submitted questions
        if ($request->has('questions')) {
            foreach ($request->questions as $index => $q) {
                if (!empty($q['id'])) {
                    $material->questions()->where('id', $q['id'])->update([
                        'category' => $q['category'],
                        'text' => $q['text'],
                        'order' => $index,
                    ]);
                } else {
                    $material->questions()->create([
                        'category' => $q['category'],
                        'text' => $q['text'],
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.tribes.show', $tribe)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Tribe $tribe, Material $material)
    {
        $material->delete();
        return redirect()->route('admin.tribes.show', $tribe)
            ->with('success', 'Materi berhasil dihapus.');
    }
}
