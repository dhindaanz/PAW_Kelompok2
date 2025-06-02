<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
