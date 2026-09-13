<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profil.edit', [
            'user' => $user,
            'bookmarkCount' => $user->bookmarks()->count(),
            'quizCount' => $user->quizScores()->count(),
            'bestSkor' => $user->quizScores()->max('score'),
            'flashTahu' => $user->flashcardProgress()->where('known', true)->count(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui! 👍');
    }

    public function password(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('password_status', 'Password berhasil diganti! ✅');
    }
}
