<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionGroup;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('optionGroup')->orderBy('order')->get();
        $optionGroups = OptionGroup::all();
        return view('admin.questions.index', compact('questions', 'optionGroups'));
    }

    public function create()
    {
        $optionGroups = OptionGroup::all();
        return view('admin.questions.create', compact('optionGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'option_group_id' => 'required|exists:option_groups,id',
            'order' => 'nullable|integer',
        ]);

        Question::create([
            'text' => $request->text,
            'option_group_id' => $request->option_group_id,
            'order' => $request->order ?? Question::max('order') + 1,
        ]);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Question $question)
    {
        $optionGroups = OptionGroup::all();
        return view('admin.questions.edit', compact('question', 'optionGroups'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'text' => 'required|string',
            'option_group_id' => 'required|exists:option_groups,id',
            'order' => 'nullable|integer',
        ]);

        $question->update($request->only('text', 'option_group_id', 'order'));

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil dihapus.');
    }
}
