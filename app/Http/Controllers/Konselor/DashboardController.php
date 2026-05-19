<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $konseliList = \App\Models\User::where('selected_counselor_id', $user->id)
            ->with(['wellbeingAnswers', 'selectedTribe'])
            ->get()
            ->map(function ($konseli) {
                $konseli->pre_test = $konseli->wellbeingAnswers->where('type', 'pre_test')->first();
                $konseli->post_test = $konseli->wellbeingAnswers->where('type', 'post_test')->first();
                $konseli->self_help_count = \App\Models\SelfHelpAnswer::where('konseli_id', $konseli->id)->count();
                return $konseli;
            });

        return view('konselor.dashboard', compact('konseliList'));
    }
}
