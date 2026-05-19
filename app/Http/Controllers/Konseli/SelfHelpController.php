<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\SelfHelpAnswer;
use App\Models\Tribe;
use Illuminate\Http\Request;

class SelfHelpController extends Controller
{
    public function show(Tribe $tribe)
    {
        $tribe->load('materials.questions');
        $user = auth()->user();

        // Get existing answers
        $answers = SelfHelpAnswer::where('konseli_id', $user->id)
            ->whereHas('materialQuestion', function ($q) use ($tribe) {
                $q->whereHas('material', function ($q2) use ($tribe) {
                    $q2->where('tribe_id', $tribe->id);
                });
            })
            ->pluck('answer_text', 'material_question_id')
            ->toArray();

        return view('konseli.self-help.show', compact('tribe', 'answers'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'material_question_id' => 'required|exists:material_questions,id',
            'answer_text' => 'required|string',
        ]);

        SelfHelpAnswer::updateOrCreate(
            [
                'konseli_id' => auth()->id(),
                'material_question_id' => $request->material_question_id,
            ],
            ['answer_text' => $request->answer_text]
        );

        return response()->json(['success' => true]);
    }
}
