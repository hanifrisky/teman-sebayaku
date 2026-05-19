<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class CounselorController extends Controller
{
    public function index()
    {
        $counselors = User::where('role', 'konselor')
            ->with('counselorProfile')
            ->latest()
            ->get();
        return view('admin.counselors.index', compact('counselors'));
    }

    public function create()
    {
        return view('admin.counselors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'description' => 'nullable|string',
            'motto' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'konselor',
        ]);

        $profileData = $request->only('description', 'motto', 'whatsapp_number');

        if ($request->hasFile('photo')) {
            $profileData['photo_path'] = $request->file('photo')->store('counselor-photos', 'public');
        }

        $user->counselorProfile()->create($profileData);

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor berhasil ditambahkan.');
    }

    public function edit(User $counselor)
    {
        $counselor->load('counselorProfile');
        return view('admin.counselors.edit', compact('counselor'));
    }

    public function update(Request $request, User $counselor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $counselor->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'description' => 'nullable|string',
            'motto' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ]);

        $counselor->update([
            'name' => $request->name,
            'email' => $request->email,
            ...(($request->password) ? ['password' => Hash::make($request->password)] : []),
        ]);

        $profileData = $request->only('description', 'motto', 'whatsapp_number');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($counselor->counselorProfile?->photo_path) {
                Storage::disk('public')->delete($counselor->counselorProfile->photo_path);
            }
            $profileData['photo_path'] = $request->file('photo')->store('counselor-photos', 'public');
        }

        $counselor->counselorProfile()->updateOrCreate(
            ['user_id' => $counselor->id],
            $profileData
        );

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor berhasil diperbarui.');
    }

    public function destroy(User $counselor)
    {
        if ($counselor->counselorProfile?->photo_path) {
            Storage::disk('public')->delete($counselor->counselorProfile->photo_path);
        }
        $counselor->delete();
        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor berhasil dihapus.');
    }
}
