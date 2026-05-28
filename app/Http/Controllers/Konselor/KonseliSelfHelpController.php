<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\SelfHelpAnswer;
use App\Models\User;

class KonseliSelfHelpController extends Controller
{
    public function show(User $user)
    {
        abort_unless($user->selected_counselor_id == auth()->id(), 403);

        $tribe = $user->selectedTribe;

        $answers = [];
        if ($tribe) {
            $tribe->load('materials.questions');
            $answers = SelfHelpAnswer::where('konseli_id', $user->id)
                ->pluck('answer_text', 'material_question_id')
                ->toArray();
        }

        return view('konselor.konseli.self-help', compact('user', 'tribe', 'answers'));
    }
}
