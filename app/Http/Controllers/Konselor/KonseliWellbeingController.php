<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WellbeingAnswer;

class KonseliWellbeingController extends Controller
{
    public function show(User $user)
    {
        // Verify this konseli belongs to the logged-in konselor
        abort_unless($user->selected_counselor_id === auth()->id(), 403);

        $preTest = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->first();

        $postTest = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', 'post_test')
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->first();

        return view('konselor.konseli.wellbeing', compact('user', 'preTest', 'postTest'));
    }

    public function reset(User $user, string $type)
    {
        // Verify this konseli belongs to the logged-in konselor
        abort_unless($user->selected_counselor_id === auth()->id(), 403);

        // Validate type is pre_test or post_test
        abort_unless(in_array($type, ['pre_test', 'post_test']), 400);

        // Delete the wellbeing answer (the details will cascade delete due to DB constraints)
        WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', $type)
            ->delete();

        return redirect()->back()->with('success', 'Hasil ' . ($type === 'pre_test' ? 'Pre-Test' : 'Post-Test') . ' berhasil di-reset.');
    }
}
