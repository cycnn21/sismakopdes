<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view(
            'user.riwayat.index',
            compact('transaksis')
        );
    }

    public function show(Transaksi $transaksi)
    {
        abort_if($transaksi->user_id != Auth::id(), 403);

        $transaksi->load('detailTransaksis.barang');

        return view(
            'user.riwayat.show',
            compact('transaksi')
        );
    }
}
