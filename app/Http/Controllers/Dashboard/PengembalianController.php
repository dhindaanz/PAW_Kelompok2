<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }
}
