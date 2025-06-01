<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
