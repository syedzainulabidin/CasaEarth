<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $user_account = $user->google_id ?? '';

        return view('dashboard.profile.index', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Update name
        $user->name = $validated['name'];

        // Update password only if filled
        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            'confirm_delete' => 'accepted',
        ], [
            'confirm_delete.accepted' => 'You must confirm before deleting your account.',
        ]);

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}
