<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::with('kategori')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'List of books',
            'data' => $buku,
        ]);
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
        } else {
            $validatedData['gambar'] = null;
        }

        $buku = Buku::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
            'data' => $buku,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Book details',
            'data' => $buku,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        $validatedData = $request->validate([
            'kode_buku' => 'nullable|string|max:20|unique:bukus,kode_buku,' . $buku->id,
            'judul' => 'nullable|string|max:255',
            'pengarang' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'nullable|integer|exists:kategoris,id',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/buku'), $filename);
            $validatedData['gambar'] = 'uploads/buku/' . $filename;

            if ($buku->gambar && file_exists(public_path($buku->gambar))) {
                unlink(public_path($buku->gambar));
            }
        } else {
            $validatedData['gambar'] = $buku->gambar;
        }

        $buku->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
            'data' => $buku,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->gambar && file_exists(public_path($buku->gambar))) {
            unlink(public_path($buku->gambar));
        }

        $buku->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully',
        ], 204);
    }
}
