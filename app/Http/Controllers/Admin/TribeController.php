<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tribe;
use Illuminate\Http\Request;

class TribeController extends Controller
{
    public function index()
    {
        $tribes = Tribe::withCount('materials')->latest()->get();
        return view('admin.tribes.index', compact('tribes'));
    }

    public function create()
    {
        return view('admin.tribes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Tribe::create(['name' => $request->name]);
        return redirect()->route('admin.tribes.index')
            ->with('success', 'Suku berhasil ditambahkan.');
    }

    public function show(Tribe $tribe)
    {
        $tribe->load('materials.questions');
        return view('admin.tribes.show', compact('tribe'));
    }

    public function edit(Tribe $tribe)
    {
        return view('admin.tribes.edit', compact('tribe'));
    }

    public function update(Request $request, Tribe $tribe)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $tribe->update(['name' => $request->name]);
        return redirect()->route('admin.tribes.index')
            ->with('success', 'Suku berhasil diperbarui.');
    }

    public function destroy(Tribe $tribe)
    {
        $tribe->delete();
        return redirect()->route('admin.tribes.index')
            ->with('success', 'Suku berhasil dihapus.');
    }
}
