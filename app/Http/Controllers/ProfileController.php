<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Halaman edit profil
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    // Update data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // max 2MB
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan file baru di storage/public/profile-photos
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
            $user->profile_photo_url = Storage::url($path);
        }

        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    // Method destroy dihapus karena hapus akun tidak digunakan
}
