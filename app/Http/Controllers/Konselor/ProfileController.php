<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load('counselorProfile');
        return view('konselor.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'motto' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'password' => ['nullable', 'confirmed'],
        ]);

        $user->update([
            'name' => $request->name,
            ...(($request->password) ? ['password' => Hash::make($request->password)] : []),
        ]);

        $profileData = $request->only('description', 'motto', 'whatsapp_number');

        if ($request->hasFile('photo')) {
            if ($user->counselorProfile?->photo_path) {
                Storage::disk('public')->delete($user->counselorProfile->photo_path);
            }
            $profileData['photo_path'] = $request->file('photo')->store('counselor-photos', 'public');
        }

        $user->counselorProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
