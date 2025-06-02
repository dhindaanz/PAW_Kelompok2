<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isAdmin = auth('web')->user()->is_admin;
        $anggota = User::with('profile:id,user_id,nim')->where('is_admin', false)->get();

        return view('dashboard.anggota.index', compact('anggota', 'isAdmin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = User::with('profile', 'peminjaman', 'peminjaman.buku:id,judul,kode_buku')->findOrFail($id);
        $peminjaman = $anggota->peminjaman()->with('buku')->get();

        return view('dashboard.anggota.show', compact('anggota', 'peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = User::with('profile')->findOrFail($id);

        return view('dashboard.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:10|unique:user_profiles,nim,' . $user->id,
            'prodi' => 'required|string|max:45',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'no_hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = $user->profile;
        if (!$profile) {
            return back()->withErrors(['profile' => 'Profile not found.']);
        }

        try {
            DB::beginTransaction();

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

            DB::commit();

            Alert::success('Success', 'Profile updated successfully!');

            return to_route('anggota.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Error', 'Something went wrong while updating the profile. Please try again.');

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile && file_exists(public_path($user->profile->foto))) {
            unlink(public_path($user->profile->foto));
        }

        $user->delete();

        Alert::success('Success', 'Anggota deleted successfully!');

        return to_route('anggota.index');
    }
}
