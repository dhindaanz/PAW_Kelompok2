<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'buku_id' => 'required|string|max:20|exists:bukus,id',
            'durasi' => 'required|integer|min:1|max:7',
        ]);

        $buku = Buku::findOrFail($validatedData['buku_id']);

        if (!$buku->is_available) {
            return back()->withErrors(['buku_id' => 'Buku ini tidak tersedia untuk dipinjam.']);
        }

        try {
            DB::beginTransaction();
            $buku->is_available = false;
            $buku->save();

            $days = (int) $validatedData['durasi'];
            $peminjaman = Peminjaman::create([
                'user_id' => $validatedData['user_id'],
                'buku_id' => $validatedData['buku_id'],
                'tanggal_pinjam' => Carbon::now()->toDateString(),
                'tanggal_wajib_kembali' => Carbon::now()->addDays($days)->toDateString(),
            ]);

            DB::commit();

            if ($peminjaman) {
                Alert::success('Berhasil', 'Peminjaman berhasil dibuat!');
                return redirect()->route('peminjaman.index');
            } else {
                Alert::error('Gagal', 'Gagal membuat peminjaman. Silakan coba lagi.');
                return back();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
