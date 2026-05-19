<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\Tribe;
use Illuminate\Http\Request;

class TribeSelectController extends Controller
{
    public function index()
    {
        $tribes = Tribe::withCount('materials')->get();
        $selectedTribeId = auth()->user()->selected_tribe_id;
        return view('konseli.tribe.index', compact('tribes', 'selectedTribeId'));
    }

    public function select(Request $request, Tribe $tribe)
    {
        auth()->user()->update(['selected_tribe_id' => $tribe->id]);

        return redirect()->route('konseli.self-help.show', $tribe)
            ->with('success', 'Suku berhasil dipilih.');
    }
}
