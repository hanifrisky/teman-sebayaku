<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\Interpretation;
use App\Models\Question;
use App\Models\WellbeingAnswer;
use App\Models\WellbeingAnswerDetail;
use Illuminate\Http\Request;

class WellbeingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $preTest = WellbeingAnswer::where('konseli_id', $user->id)->where('type', 'pre_test')->first();
        $postTest = WellbeingAnswer::where('konseli_id', $user->id)->where('type', 'post_test')->first();
        
        $canTakePostTest = $preTest && $preTest->status === 'completed';
        
        return view('konseli.wellbeing.index', compact('preTest', 'postTest', 'canTakePostTest'));
    }

    public function show(string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $user = auth()->user();
        $questions = Question::with('optionGroup.items')->orderBy('order')->get();

        $answer = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->with('details')
            ->first();

        // If completed, redirect to result
        if ($answer && $answer->isCompleted()) {
            return redirect()->route('konseli.wellbeing.result', $type);
        }

        $answeredIds = $answer ? $answer->details->pluck('question_id')->toArray() : [];

        return view('konseli.wellbeing.show', compact('type', 'questions', 'answer', 'answeredIds'));
    }

    public function start(Request $request, string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $request->validate(['konseli_name' => 'required|string|max:255']);

        $user = auth()->user();

        // Delete existing answer if re-doing
        WellbeingAnswer::where('konseli_id', $user->id)->where('type', $type)->delete();

        WellbeingAnswer::create([
            'konseli_id' => $user->id,
            'type' => $type,
            'konseli_name' => $request->konseli_name,
            'status' => 'draft',
            'started_at' => now(),
        ]);

        return redirect()->route('konseli.wellbeing.show', $type);
    }

    public function save(Request $request, string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $user = auth()->user();
        $answer = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->where('status', 'draft')
            ->firstOrFail();

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'required|exists:option_items,id',
            'score' => 'required|integer',
        ]);

        WellbeingAnswerDetail::updateOrCreate(
            [
                'wellbeing_answer_id' => $answer->id,
                'question_id' => $request->question_id,
            ],
            [
                'selected_option_id' => $request->selected_option_id,
                'score' => $request->score,
            ]
        );

        return response()->json(['success' => true]);
    }

    public function finish(Request $request, string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $user = auth()->user();
        $answer = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->where('status', 'draft')
            ->firstOrFail();

        $totalQuestions = Question::count();
        $answeredCount = $answer->details()->count();

        if ($answeredCount < $totalQuestions) {
            return back()->with('error', 'Harap jawab semua soal terlebih dahulu.');
        }

        $totalScore = $answer->details()->sum('score');

        // Find matching interpretation
        $interpretation = Interpretation::where('min_score', '<=', $totalScore)
            ->where('max_score', '>=', $totalScore)
            ->first();

        $answer->update([
            'status' => 'completed',
            'total_score' => $totalScore,
            'interpretation_id' => $interpretation?->id,
            'completed_at' => now(),
        ]);

        return redirect()->route('konseli.wellbeing.result', $type);
    }

    public function result(string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $user = auth()->user();
        $answer = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->firstOrFail();

        return view('konseli.wellbeing.result', compact('type', 'answer'));
    }

    public function downloadPdf(string $type)
    {
        abort_unless(in_array($type, ['pre_test', 'post_test']), 404);

        $user = auth()->user();
        $answer = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('konseli.wellbeing.pdf', compact('answer', 'type'));
        $filename = "wellbeing_{$type}_{$user->id}.pdf";

        return $pdf->download($filename);
    }
}
