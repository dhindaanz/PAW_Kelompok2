<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = null;
        $currentUser = auth('web')->user();
        $isAdmin = $currentUser->is_admin;

        if ($isAdmin) {
            $peminjaman = Peminjaman::with(['buku:id,judul,kode_buku', 'user:id,name'])->orderBy('updated_at', 'desc')->get();
        } else {
            $peminjaman = $currentUser->load('peminjaman')->peminjaman->with(['buku:id,judul,kode_buku', 'user:id,name'])->orderBy('updated_at', 'desc')->get();
        }

        return view('dashboard.peminjaman.index', compact('isAdmin', 'peminjaman'));
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
}
