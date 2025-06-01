<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:10|unique:user_profiles',
            'prodi' => 'required|string|max:45',
            'angkatan' => 'required|integer|min:2000|max:'.(date('Y') + 1),
            'no_hp' => 'required|string|max:45',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'nim' => $validatedData['nim'],
            'prodi' => $validatedData['prodi'],
            'angkatan' => $validatedData['angkatan'],
            'no_hp' => $validatedData['no_hp'],
            'foto' => null
        ]);

        return to_route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
