<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interpretation;
use Illuminate\Http\Request;

class InterpretationController extends Controller
{
    public function index()
    {
        $interpretations = Interpretation::orderBy('min_score')->get();
        return view('admin.interpretations.index', compact('interpretations'));
    }

    public function create()
    {
        return view('admin.interpretations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_score' => 'required|integer|min:0',
            'max_score' => 'required|integer|gte:min_score',
            'description' => 'required|string',
        ]);

        Interpretation::create($request->only('min_score', 'max_score', 'description'));

        return redirect()->route('admin.interpretations.index')
            ->with('success', 'Intepretasi berhasil ditambahkan.');
    }

    public function edit(Interpretation $interpretation)
    {
        return view('admin.interpretations.edit', compact('interpretation'));
    }

    public function update(Request $request, Interpretation $interpretation)
    {
        $request->validate([
            'min_score' => 'required|integer|min:0',
            'max_score' => 'required|integer|gte:min_score',
            'description' => 'required|string',
        ]);

        $interpretation->update($request->only('min_score', 'max_score', 'description'));

        return redirect()->route('admin.interpretations.index')
            ->with('success', 'Intepretasi berhasil diperbarui.');
    }

    public function destroy(Interpretation $interpretation)
    {
        $interpretation->delete();
        return redirect()->route('admin.interpretations.index')
            ->with('success', 'Intepretasi berhasil dihapus.');
    }
}
