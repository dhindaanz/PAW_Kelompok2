<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $riwayatPeminjaman = Peminjaman::with(['user', 'buku'])->get();

        $pdf = Pdf::loadView('dashboard.peminjaman.laporan', [
            'riwayatPeminjaman' => $riwayatPeminjaman,
        ]);

        return $pdf->download('laporan-peminjaman.pdf');
    }
}
