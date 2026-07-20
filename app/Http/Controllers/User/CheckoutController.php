<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()
                ->route('user.keranjang.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = $keranjangs->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view(
            'user.checkout.index',
            compact('keranjangs', 'total')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|max:255',
            'telepon' => 'required|max:20',
            'alamat' => 'required',
            'catatan' => 'nullable',
        ]);

        $keranjangs = Keranjang::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()
                ->route('user.keranjang.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {

            // Generate kode transaksi
            $last = Transaksi::latest()->first();

            if ($last) {
                $nomor = intval(substr($last->kode_transaksi, 4));
                $kode = 'TRX-' . str_pad($nomor + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $kode = 'TRX-000001';
            }

            // Hitung total
            $total = $keranjangs->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode,
                'user_id' => Auth::id(),
                'tanggal' => now()->toDateString(),
                'total' => $total,
                'status' => 'Menunggu',
                'nama_penerima' => $request->nama_penerima,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'catatan' => $request->catatan,
            ]);

            // Simpan detail transaksi & kurangi stok
            foreach ($keranjangs as $item) {

                $barang = $item->barang;

                if ($barang->stok < $item->jumlah) {
                    throw new \Exception(
                        'Stok barang ' . $barang->nama_barang . ' tidak mencukupi.'
                    );
                }

                $subtotal = $item->harga * $item->jumlah;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'qty' => $item->jumlah,
                    'harga' => $item->harga,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok
                $barang->decrement('stok', $item->jumlah);
            }

            // Kosongkan keranjang
            Keranjang::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()
                ->route('user.riwayat.index')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat dengan kode ' . $transaksi->kode_transaksi
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}