<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Http\Request;

class MaterialQuestionController extends Controller
{
    public function store(Request $request, Material $material)
    {
        $request->validate([
            'category' => 'required|in:W,D,E,P',
            'text' => 'required|string',
        ]);

        $material->questions()->create([
            'category' => $request->category,
            'text' => $request->text,
            'order' => $material->questions()->max('order') + 1,
        ]);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function destroy(Material $material, MaterialQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
