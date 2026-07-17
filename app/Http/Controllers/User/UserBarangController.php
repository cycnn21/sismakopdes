<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class UserBarangController extends Controller
{
    /**
     * Menampilkan katalog barang
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $barangs = Barang::with([
                'kategori',
                'supplier'
            ])
            ->where('status', 'aktif')
            ->where('stok', '>', 0)

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'nama_barang',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'kode_barang',
                        'like',
                        "%{$search}%"
                    );

                });

            })

            ->orderBy('nama_barang')
            ->paginate(12)
            ->withQueryString();

        return view(
            'user.katalog.index',
            compact(
                'barangs',
                'search'
            )
        );
    }

    /**
     * Detail barang
     */
    public function show(Barang $barang)
    {
        $barang->load([
            'kategori',
            'supplier'
        ]);

        return view(
            'user.katalog.show',
            compact('barang')
        );
    }
}