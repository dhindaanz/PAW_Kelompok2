<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('web')->user()->load('profile');

        return view('auth.profile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth('web')->user();

        return view('auth.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth('web')->user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:10|unique:user_profiles,nim,' . $user->id,
            'prodi' => 'required|string|max:45',
            'angkatan' => 'required|integer|min:2000|max:'.(date('Y') + 1),
            'no_hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = UserProfile::where('user_id', $user->id)->first();
        if (!$profile) {
            return back()->withErrors(['profile' => 'Profile not found.']);
        }

        $user->name = $validatedData['name'];
        $profile->nim = $validatedData['nim'];
        $profile->prodi = $validatedData['prodi'];
        $profile->angkatan = $validatedData['angkatan'];
        $profile->no_hp = $validatedData['no_hp'];

        if ($request->hasFile('foto')) {
            if ($profile->foto && file_exists(public_path($profile->foto))) {
                unlink(public_path($profile->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/foto'), $filename);
            $profile->foto = 'uploads/foto/' . $filename;
        }

        $user->save();
        $profile->save();

        return to_route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
