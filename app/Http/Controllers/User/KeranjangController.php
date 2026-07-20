<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Menampilkan isi keranjang
     */
    public function index()
    {
        $keranjangs = Keranjang::with([
    'barang.kategori'
])
->where('user_id', Auth::id())
->latest()
->get();

$total = $keranjangs->sum(function($item){

    return $item->subtotal;

});

return view(
    'user.keranjang.index',
    compact(
        'keranjangs',
        'total'
    )
);
    }

    /**
     * Form create tidak digunakan
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Tambah barang ke keranjang
     */
    public function store(Request $request)
    {
        $request->validate([

            'barang_id' => 'required|exists:barangs,id',

            'jumlah' => 'required|integer|min:1',

        ]);


        $barang = Barang::findOrFail(
            $request->barang_id
        );


        if ($barang->stok < $request->jumlah) {

            return back()
                ->withErrors([
                    'jumlah' => 'Stok tidak mencukupi.'
                ])
                ->withInput();

        }


        $keranjang = Keranjang::where(
                'user_id',
                Auth::id()
            )
            ->where(
                'barang_id',
                $request->barang_id
            )
            ->first();


        if ($keranjang) {

            $jumlahBaru =
                $keranjang->jumlah +
                $request->jumlah;

            if ($jumlahBaru > $barang->stok) {

                return back()
                    ->withErrors([
                        'jumlah' => 'Jumlah melebihi stok.'
                    ]);

            }

            $keranjang->update([
                'jumlah' => $jumlahBaru
            ]);

        } else {

            Keranjang::create([

    'user_id'   => Auth::id(),

    'barang_id' => $barang->id,

    'jumlah'    => $request->jumlah,

    'harga'     => $barang->harga_jual,

]);

        }


        return redirect()
            ->route('user.keranjang.index')
            ->with(
                'success',
                'Barang berhasil ditambahkan ke keranjang.'
            );
    }

    /**
     * Detail keranjang tidak digunakan
     */
    public function show(Keranjang $keranjang)
    {
        abort(404);
    }

    /**
     * Form edit tidak digunakan
     */
    public function edit(Keranjang $keranjang)
    {
        abort(404);
    }

    /**
     * Update jumlah
     */
    public function update(
        Request $request,
        Keranjang $keranjang
    ) {

        $request->validate([

            'jumlah' =>
                'required|integer|min:1',

        ]);


        if (
            $request->jumlah >
            $keranjang->barang->stok
        ) {

            return back()
                ->withErrors([
                    'jumlah' =>
                    'Jumlah melebihi stok.'
                ]);

        }


        $keranjang->update([

            'jumlah' =>
                $request->jumlah

        ]);


        return back()->with(
            'success',
            'Jumlah berhasil diperbarui.'
        );
    }

    /**
     * Hapus keranjang
     */
    public function destroy(
        Keranjang $keranjang
    ) {

        $keranjang->delete();

        return back()->with(
            'success',
            'Barang dihapus dari keranjang.'
        );
    }
}