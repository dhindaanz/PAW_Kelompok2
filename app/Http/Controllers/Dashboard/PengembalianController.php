<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth('web')->user();
        $isAdmin = $currentUser->is_admin;
        $buku = Buku::where('is_available', false)->get();

        $peminjam = null;

        if ($isAdmin) {
            $peminjam = User::with('profile')->get();
        } else {
            $peminjam = $currentUser->load('profile');
        }

        $referrer = url()->previous();
        if (str_contains($referrer, 'peminjaman/create')) {
            $referrer = route('peminjaman.index');
        }
        $referrer = parse_url($referrer, PHP_URL_PATH);

        return view('dashboard.pengembalian.index', compact('peminjam', 'buku', 'isAdmin', 'referrer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'buku_id' => 'required|integer|exists:bukus,id',
        ]);

        $buku = Buku::find($validatedData['buku_id']);

        if (!$buku) {
            return back()->withErrors(['error' => 'Buku tidak ditemukan.']);
        }

        try {
            $buku->is_available = true;
            $buku->save();

            $peminjam = Peminjaman::where('user_id', $validatedData['user_id'])
                ->where('buku_id', $validatedData['buku_id'])
                ->whereNull('tanggal_pengembalian')
                ->first();

            if (!$peminjam) {
                return back()->withErrors(['error' => 'Peminjaman tidak ditemukan.']);
            }

            $peminjam->tanggal_pengembalian = now();
            $peminjam->save();

            DB::commit();
            Alert::success('Berhasil', 'Buku berhasil dikembalikan.');
            return to_route('pengembalian.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Gagal mengembalikan buku: ' . $e->getMessage());
            return back();
        }
    }
}
