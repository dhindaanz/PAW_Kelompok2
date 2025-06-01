<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isAdmin = auth('web')->user()->is_admin;

        if ($request->has('search')) {
            $buku = Buku::with('kategori')->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('pengarang', 'like', '%' . $request->search . '%')
                ->orWhere('penerbit', 'like', '%' . $request->search . '%')
                ->orWhere('tahun_terbit', 'like', '%' . $request->search . '%')
                ->orWhere('kode_buku', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $buku = Buku::with('kategori')->paginate(10);
        }

        return view('dashboard.buku.index', compact('buku', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('dashboard.buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_buku' => 'required|string|max:20|unique:bukus,kode_buku',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required|integer|exists:kategoris,id',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/buku'), $filename);
            $validatedData['gambar'] = 'uploads/buku/' . $filename;
        }

        Buku::create($validatedData);

        Alert::success('Berhasil', 'Buku berhasil ditambahkan!');

        return to_route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return view('dashboard.buku.show', compact('buku'));
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
