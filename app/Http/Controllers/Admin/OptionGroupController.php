<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionGroup;
use App\Models\OptionItem;
use Illuminate\Http\Request;

class OptionGroupController extends Controller
{
    public function index()
    {
        $groups = OptionGroup::with('items')->latest()->get();
        return view('admin.option-groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.option-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.label' => 'required|string|max:255',
            'items.*.score' => 'required|integer',
        ]);

        $group = OptionGroup::create(['name' => $request->name]);

        foreach ($request->items as $index => $item) {
            $group->items()->create([
                'label' => $item['label'],
                'score' => $item['score'],
                'order' => $index,
            ]);
        }

        return redirect()->route('admin.option-groups.index')
            ->with('success', 'Grup pilihan berhasil dibuat.');
    }

    public function edit(OptionGroup $optionGroup)
    {
        $optionGroup->load('items');
        return view('admin.option-groups.edit', compact('optionGroup'));
    }

    public function update(Request $request, OptionGroup $optionGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.label' => 'required|string|max:255',
            'items.*.score' => 'required|integer',
        ]);

        $optionGroup->update(['name' => $request->name]);

        // Delete old items and recreate
        $optionGroup->items()->delete();
        foreach ($request->items as $index => $item) {
            $optionGroup->items()->create([
                'label' => $item['label'],
                'score' => $item['score'],
                'order' => $index,
            ]);
        }

        return redirect()->route('admin.option-groups.index')
            ->with('success', 'Grup pilihan berhasil diperbarui.');
    }

    public function destroy(OptionGroup $optionGroup)
    {
        $optionGroup->delete();
        return redirect()->route('admin.option-groups.index')
            ->with('success', 'Grup pilihan berhasil dihapus.');
    }
}
