<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori =  Kategori::with('buku')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'List of categories',
            'data' => $kategori,
        ]);
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

        $kategori = Kategori::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $kategori,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::with('buku')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category details',
            'data' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'nullable|string|min:2|max:45|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'data' => $kategori,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully',
        ], 204);
    }
}
