<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('user')
            ->latest()
            ->paginate(10);

        return view(
            'admin.transaksi.index',
            compact('transaksis')
        );
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load([
            'user',
            'detailTransaksis.barang'
        ]);

        return view(
            'admin.transaksi.show',
            compact('transaksi')
        );
    }
}