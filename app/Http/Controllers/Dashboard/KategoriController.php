<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isAdmin = auth('web')->user()->is_admin;
        $kategori = Kategori::all();

        return view('dashboard.kategori.index', compact('isAdmin', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|min:2|max:45|unique:kategoris,nama',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Kategori::create($validatedData);

        Alert::success('Berhasil', 'Kategori berhasil ditambahkan.');

        return to_route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $isAdmin = auth('web')->user()->is_admin;
        $kategori = Kategori::findOrFail($id);
        $buku = $kategori->buku()->get();

        return view('dashboard.kategori.show', compact('isAdmin', 'kategori', 'buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('dashboard.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|min:2|max:45|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori->update($validatedData);

        Alert::success('Berhasil', 'Kategori berhasil diperbarui.');

        return to_route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        Alert::success('Berhasil', 'Kategori berhasil dihapus.');

        return to_route('kategori.index');
    }
}
