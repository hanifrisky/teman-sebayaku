<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = \App\Models\User::where('selected_counselor_id', $user->id)
            ->with(['wellbeingAnswers', 'selectedTribe']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Handle 'all' by using a large integer
        $limit = ($perPage === 'all') ? 999999 : (int)$perPage;

        $konseliList = $query->paginate($limit)
            ->appends($request->all())
            ->through(function ($konseli) {
                $konseli->pre_test = $konseli->wellbeingAnswers->where('type', 'pre_test')->first();
                $konseli->post_test = $konseli->wellbeingAnswers->where('type', 'post_test')->first();
                $konseli->self_help_count = \App\Models\SelfHelpAnswer::where('konseli_id', $konseli->id)->count();
                return $konseli;
            });

        return view('konselor.dashboard', compact('konseliList'));
    }
}
