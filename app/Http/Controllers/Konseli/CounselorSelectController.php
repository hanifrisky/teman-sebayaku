<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CounselorSelectController extends Controller
{
    public function index()
    {
        $counselors = User::where('role', 'konselor')
            ->with('counselorProfile')
            ->get();

        $selectedCounselorId = auth()->user()->selected_counselor_id;

        return view('konseli.counselor.index', compact('counselors', 'selectedCounselorId'));
    }

    public function select(Request $request, User $user)
    {
        abort_unless($user->role === 'konselor', 404);

        auth()->user()->update(['selected_counselor_id' => $user->id]);

        return redirect()->route('konseli.tribe.index')
            ->with('success', 'Konselor berhasil dipilih.');
    }
}
