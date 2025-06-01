<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $buku = Buku::count();
        $kategori = Kategori::count();
        $currentUser = auth('web')->user()->load('peminjaman');

        if ($currentUser->is_admin == 0) {
            $peminjaman = $currentUser->peminjaman->count(0);

            return view('dashboard.user', [
                'buku' => $buku,
                'kategori' => $kategori,
                'peminjaman' => $peminjaman,
                'currentUser' => $currentUser,
            ]);
        }

        $user = User::where('is_admin', false)->count();
        $peminjaman = Peminjaman::with(['user', 'buku'])->orderBy('updated_at', 'desc')->get();
        $jumlahPeminjaman = $peminjaman->count();

        return view('dashboard.admin', [
            'user' => $user,
            'buku' => $buku,
            'kategori' => $kategori,
            'peminjaman' => $peminjaman,
            'jumlahPeminjaman' => $jumlahPeminjaman,
        ]);
    }
}
