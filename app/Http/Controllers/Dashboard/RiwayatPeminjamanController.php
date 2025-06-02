<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
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
            $peminjaman = $currentUser->load('peminjaman')->peminjaman()->with(['buku:id,judul,kode_buku', 'user:id,name'])->orderBy('updated_at', 'desc')->get();
        }

        return view('dashboard.peminjaman.index', compact('isAdmin', 'peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $currentUser = auth('web')->user();
        $isAdmin = $currentUser->is_admin;

        $buku = null;
        $peminjam = null;

        if ($isAdmin) {
            $peminjam = User::with('profile')->get();
        } else {
            $peminjam = $currentUser->load('profile');
        }

        if ($request->has('kode_buku')) {
            $buku = Buku::where('kode_buku', $request->kode_buku)->get();
        } else {
            $buku = Buku::where('is_available', true)->get();
        }

        $referrer = url()->previous();
        if (str_contains($referrer, 'peminjaman/create')) {
            $referrer = route('peminjaman.index');
        }
        $referrer = parse_url($referrer, PHP_URL_PATH);

        return view('dashboard.peminjaman.create', compact('buku', 'peminjam', 'isAdmin', 'referrer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
}
